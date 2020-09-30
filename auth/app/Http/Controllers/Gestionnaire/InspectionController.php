<?php

namespace App\Http\Controllers\Gestionnaire;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lot;
use App\Models\Test;
use App\Models\Inspection;
use App\Models\Alert;
use App\Models\Produit;
use App\Models\Examen;
use App\Models\Reponse;
use App\Models\Event;
use Auth;
use Carbon\Carbon;
use Redirect,Response;
use PDF;
use App\Exports\InspectionsExport;
use Maatwebsite\Excel\Facades\Excel;


class InspectionController extends Controller{

    public function export(){      
        $year = Carbon::now()->format('Y');
        return (new InspectionsExport($year))->download('Journal des inspections '.$year.'.xlsx');
    }

    public function index(){
    	$inspections = Inspection::orderBy('id','desc')->paginate(10);
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
        $request->validate([
            'titre' => 'required',
            'date' => 'required',
            'description' => 'required',
            'productimg' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'produit' => 'required',
            'caracteristiquep' => 'required',
            'quantite' => ['required','integer'],
            'test' => 'required'
        ]);
        if(empty($request->id)){
            $inspection = new Inspection();
        }
        else{
            $inspection = Inspection::findOrFail($request->id);
        }

        if(empty($inspection->lot)){
            $lot = new Lot();
        }
        else{
            $lot = Lot::findOrFail($inspection->lot_id);
        }

        $lot->quantite = $request->quantite;
        $lot->produit_id = $request->produit;
        $lot->caracteristiquep = $request->caracteristiquep;
        $lot->save(); 
        $inspection->lot_id = $lot->id;               

        $inspection->titre = $request->titre;
        $inspection->description = $request->description;
        $inspection->test_id = $request->test; 
        $inspection->user_id = Auth::user()->id; // Id de l'utilisateur authentifie
        if(!empty($request->productimg)){
            $fileName = "lot-" . time() . '.' . request()->productimg->getClientOriginalExtension();
            $request->productimg->storeAs('lotImage', $fileName);
            $inspection->productimg = $fileName;
        } else{
            $inspection->productImg = null;
        }

        $inspection->etat="nouveau";
        $inspection->step = 2;
        $test_id = $inspection->test_id;
        $inspection->save();
        
        if(empty($request->id)){
            $event = new Event();
            $event->title = $inspection->titre;
            $event->start = $request->date;
            $event->end = $request->date;
            $event->type = 'Inspection';
            $event->inspection_id = $inspection->id;
            $event->save(); 
        }
        else{
            $update_event = DB::table('events')
            ->where('inspection_id', $inspection->id )
            ->update(['title' => $inspection->titre, 'start' => $request->date , 
            'end' => $request->date]); 
        }
        $examens = Examen::where('test_id', '=' , $test_id )->get();
        $produits = Produit::where('type', '=' , 'Fini' )->get();
        return view('quality.inspection.create',compact('produits','inspection','examens'));    
    }

    public function postCreateStep2(Request $request){

        $inspection = Inspection::findOrFail($request->id);   
        $result = "Les réponses des examens sont toutes correctes";
        
        if (!empty($request->ReponsesEtat)){
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


    public function store(Request $request){

        $request->validate([
            'quantiteD' => 'integer',  
        ]);

        $inspection = Inspection::findOrFail($request->id);
        if (!empty($request->commentaire)){
            $inspection->commentaire = $request->commentaire;       
        }

        if (!empty($request->quantiteD)){
            $inspection->quantiteD = $request->quantiteD;
        } 
        else{
            $inspection->quantiteD  = 0;
        }

        $inspection->etat="traité";
        $inspection->step = 1;
        $inspection->save();
        
        if ($request->anomalie){
            $lotA = DB::table('lots')->insertGetId([
                'quantite' => $request->quantiteD, 
                'caracteristiquep' => $inspection->lot->caracteristiquep,
                'produit_id' => $inspection->lot->produit->id
            ]); 
            /* automaticly create an associated anomaly */
            $anomalie_id = DB::table('anomalies')->insertGetId([   
                'lot_id' => $lotA,
                'atelier_id' => 5, // atelier de controle dans le seeders
                'test_id' => $inspection->test_id,
                'type' => 'Retour production',              
                'step' => 3,    
                'etat' => "en cours",
                'titre' => $inspection->titre. ' - De Inspection',
                'description' => $inspection->description,
                'resultats' => $inspection->resultats,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]); 

            /* Associate an alert to anomaly */
            $alert = new Alert;
            $alert->type = 'Retour production';
            $alert->description = $inspection->description; 
            $alert->atelier_id = 5; // atelier de controle dans le seeders
            $alert->sent = 1;
            $alert->anomalie_id = $anomalie_id; 
            $alert->etat = "en cours";
            $alert->lot_id = $lotA; 
            $alert->save();

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
    
    function generate_pdf(Inspection $inspection) {

        $pdf = PDF::loadView('pdf.ficheInspection', compact('inspection'));
        return $pdf->stream('Fiche.pdf');
    }

    public function view(Inspection $inspection){
             
        return view('quality.inspection.view',compact('inspection'));
    }


}
