<?php

namespace App\Http\Controllers\Gestionnaire;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lot;
use App\Models\Test;
use App\Models\Inspection;
use App\Models\Produit;
use App\Models\Examen;
use App\Models\Reponse;
use App\Models\Event;
use Auth;
use Carbon\Carbon;
use Redirect,Response;

class InspectionController extends Controller
{
    public function index(){
    	$inspections = Inspection::paginate(5);
    	return view('quality.inspection.index',compact('inspections'));
    }

    public function create(Request $request){   
        $produits = Produit::where('type', '=' , 'Fini' )->get();
        return view('quality.inspection.create',compact('produits'));
    }
    
    public function createFrom(Request $request, $id){
        $event = Event::findOrFail($id);
        $event->rappel = "false"; // update rappel variable
        $event->save();
        $inspection = Inspection::where('id', '=' , $event->inspection_id)->first();
        if($event->alert != null){  
            $event->alert->etat ="en cours";
            $event->alert->save();
        }
        $produits = Produit::where('type', '=' , 'Fini' )->get();
        return view('quality.inspection.create', compact('inspection','produits'));
    }
    public function postCreateStep1(Request $request){   
        if(empty($request->id)){
            $inspection = new Inspection();
        }
        else{
            $inspection = Inspection::findOrFail($request->id);
       
            $update_lot = DB::table('events')
            ->where('inspection_id', $inspection->id )
            ->update(['title' => $inspection->titre, 'start' => $request->date , 
            'end' => $request->date]);
        }

        $request->validate([
            'titre' => 'required',
            'date' => 'required',
            'description' => 'required',
            'productimg' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'produit' => 'required',
            'caracteristique' => 'required',
            'quantite' => ['required','integer'],
            'test' => 'required'
        ]);

        $inspection->titre = $request->titre;
        $inspection->description = $request->description;
        $lot_id = DB::table('lots')->insertGetId(
            ['quantite' => $request->quantite, 'caracteristiquep' => $request->caracteristique ,'produit_id' => $request->produit]
        ); 
        $inspection->lot_id = $lot_id;
        $inspection->test_id = $request->test; 
        $inspection->user_id = Auth::user()->id; // Id de l'utilisateur authentifie
        if($request->productimg != NULL){
            $fileName = "productImage-" . time() . '.' . request()->productimg->getClientOriginalExtension();
            $request->productimg->storeAs('productimg', $fileName);
            $inspection->productimg = $fileName;
        }    
        $inspection->etat="nouveau";
        $inspection->step = 2;
        $test_id = $inspection->test_id;
        $inspection->save();

        // associer event to inspection
       if(empty($request->id)){
            $event = new Event();
            $event->title = $inspection->titre;
            $event->start = $request->date;
            $event->end = $request->date;
            $event->type = 'Inspection';
            $event->inspection_id = $inspection->id;
            $event->save();    
        }
        $examens = Examen::where('test_id', '=' , $test_id )->get();
        $produits = Produit::where('type', '=' , 'Fini' )->get();
        return view('quality.inspection.create',compact('produits','inspection','examens'));    
    }

    public function postCreateStep2(Request $request){

        $inspection = Inspection::findOrFail($request->id);   
        $result = "Les réponses des examens sont toutes correctes";
        
        if ( !empty($request->ReponsesEtat)){
            for ($i=0; $i < count($request->ReponsesEtat) ; $i++) { 
                if ($request->ReponsesEtat[$i] =="Incorrect"){
                    $result = "Les réponses des examens ne sont pas toutes correctes";     
                }
                DB::table('reponses')
                ->updateOrInsert(
                    ['inspection_id' => $inspection->id, 'examen_id' => $request->ExamensIdd[$i]],
                    ['valeur' => $request->ReponsesValeur[$i] , 
                    'examen_id' => $request->ExamensIdd[$i] ,
                    'inspection_id' => $inspection->id,
                    'etat' => $request->ReponsesEtat[$i] ]
                ); 
            }
        }
        
        $test_id = $inspection->test_id;
        $inspection->etat="en cours";
        $inspection->step = 3;        
        $inspection->resultats = $result;
        $inspection->save();
        $examens = Examen::where('test_id', '=' , $test_id )->get();
        $produits = Produit::where('type', '=' , 'Fini' )->get();
        return view('quality.inspection.create',compact('produits','inspection','examens'));
    }

  /*public function removeImage(Request $request)
    { 
        $inspection->productimg = null;
        return view('inspection.create-step1');
    }*/

    public function store(Request $request){
        $inspection = Inspection::findOrFail($request->id);
        
        $request->validate([
            'quantiteD' => ['required','integer']
        ]);

        if (!empty($request->commentaire)){
            $inspection->commentaire = $request->commentaire;       
        }

        $inspection->quantiteD = $request->quantiteD;   
        $inspection->etat="traité";
        $inspection->step = 1;
        $inspection->save();
        
        if ($request->anomalie){
            $lotA = DB::table('lots')->insertGetId(
                [
                    'quantite' => $request->quantiteD, 
                    'caracteristiquep' => $inspection->lot->caracteristique ,
                    'produit_id' => $inspection->lot->produit->id]
            ); 
           /* automaticly create an associated anomaly */
            $anomalie_id = DB::table('anomalies')->insertGetId([   
                'lot_id' => $lotA,
                'test_id' => $inspection->test_id,
                'type' => 'Retour production',              
                'step' => 3,    
                'etat' => "en cours",
                'titre' => $inspection->titre. '-fromInspection',
                'description' => $inspection->description,
                'resultats' => $inspection->resultats,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]); 
            $reponses = Reponse::where('inspection_id', '=' , $inspection->id )->get();
            for ($i=0; $i < count($reponses) ; $i++) { 
                $reponses[$i]->anomalie_id=  $anomalie_id;
                $reponses[$i]->save();
            }
            $inspection->anomalie_id = $anomalie_id; 
            $inspection->save();          
            return redirect(route('anomalie.createFrom',$anomalie_id));
        }

        return redirect(route('inspection.dashbord'))->with('successMsg',"Création d'une nouvelle inspection");

    }

    public function delete(Inspection $inspection){
        $inspection->delete();
        return redirect(route('inspection.dashbord'));
    }

    public function previous(Inspection $inspection){
        $inspection->step -= 1;
        if($inspection->step < 1) $inspection->step=1;
        $inspection->save();
        $produits = Produit::where('type', '=' , 'Fini' )->get();
        $test_id = $inspection->test_id;
        $examens = Examen::where('test_id', '=' , $test_id )->get();
        return view('quality.inspection.create', compact('inspection','produits','examens'));
    }

    public function edit(Inspection $inspection){   
        $test_id = $inspection->test_id;
        $inspection->step = 1;
        $inspection->etat = "en cours";
        $examens = Examen::where('test_id', '=' , $test_id )->get();
        $produits = Produit::where('type', '=' , 'Fini' )->get();
        return view('quality.inspection.create',compact('produits','inspection','examens')); 
    }


}
