<?php

namespace App\Http\Controllers\Gestionnaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anomalie;
use App\Models\Lot;
use App\Models\Produit;
use App\Models\Caracteristique;
use App\Models\Alert;
use App\Models\Fournisseur;
use App\Models\Client;
use App\Models\Atelier;
use App\Models\Regle;
use App\User;
use App\Models\Examen;
use App\Models\Reponse;
use Carbon\Carbon;
use DB;
use PDF;

use Illuminate\Support\Facades\Auth;

class AnomalieController extends Controller
{
    public function index(){
    	$anomalies = Anomalie::paginate(5);
    	return view('quality.anomalie.index',compact('anomalies'));
    }

    public function createFromScratch(Request $request){
        return view('quality.anomalie.create');
    }

    public function createFrom(Request $request, $id){
        $anomalie = Anomalie::findOrFail($id);
        if(!empty($anomalie)){
            //$anomalie->etat ="en cours"; // if from inspection
            //$anomalie->etat ="nouveau"; //if from alert
            //$anomalie->save();
        }
        $alerts = Alert::where('anomalie_id', '=' , $id )->
                         where('etat', '=' , 'nouveau' )->get();
        if(!empty($alerts[0])){
            $alerts[0]->etat ="en cours";
            $alerts[0]->save();
        }
        return view('quality.anomalie.create', compact('anomalie'));
    }

    public function postCreateStep1(Request $request){
        $validatedData = $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'type' => 'required',
            'test' => 'required'
        ]);

        if(empty($request->id)){
            $anomalie = new Anomalie();
            $lot_id = DB::table('lots')->insertGetId(
                ['quantite' => $request->quantite, 'produit_id' => $request->produit]
            ); 
            $anomalie->lot_id = $lot_id;               
        }
        else{
            $anomalie = Anomalie::findOrFail($request->id);
            $lot_id = DB::table('lots')
            ->where('id', $anomalie->lot_id )
            ->update(['quantite' => $request->quantite, 'produit_id' => $request->produit]);
        }

        switch ($request->type) {
            case 'Retour fournisseur':
                $anomalie->fournisseur_id = $request->fournisseur;
                break; 
            case 'Retour client':
                $anomalie->client_id = $request->client;             
                break;
            case 'Retour production':
                $anomalie->atelier_id = $request->atelier;  
                break;
        }
        $anomalie->test_id = $request->test; 
        $anomalie->type = $request->type; 
        $anomalie->titre = $request->titre; 
        $anomalie->description = $request->description; 
        $anomalie->etat="nouveau";
        $anomalie->step = 2;
        $anomalie->save();
        $examens = Examen::where('test_id', '=' , $anomalie->test_id )->get();
        return view('quality.anomalie.create', compact('anomalie','examens'));
    }

    public function postCreateStep2(Request $request){    
        $anomalie = Anomalie::findOrFail($request->id);
        $result = "Les réponses des examens sont toutes correctes, Aucune erreur detecté";
        for ($i=0; $i < count($request->ReponsesEtat) ; $i++) { 
            if ($request->ReponsesEtat[$i] =="Incorrect")
            {
                 $result = "Les réponses des examens ne sont pas toutes correctes, Existence d'une anomalie !";     
            }
            DB::table('reponses')
                ->updateOrInsert(
                    [   'anomalie_id' => $anomalie->id, 
                        'examen_id' => $anomalie->ExamensIdd[$i]
                    ],
                    [   'valeur' => $request->ReponsesValeur[$i] , 
                        'examen_id' => $request->ExamensIdd[$i] ,
                        'anomalie_id' => $anomalie->id,
                        'etat' => $request->ReponsesEtat[$i] 
                    ]
                    ); 
        }
        if($result == "Les réponses des examens ne sont pas toutes correctes, Existence d'une anomalie !"){
           /* make something red */
        }
        $anomalie->etat="en cours";
        $anomalie->step = 3;
        $anomalie->resultats = $result;
        $anomalie->save();
        $examens = Examen::where('test_id', '=' , $anomalie->test_id )->get();
        return view('quality.anomalie.create',compact('anomalie','examens'));
    }

    public function postCreateStep3(Request $request){
        $anomalie = Anomalie::findOrFail($request->id);
        $validatedData = $request->validate([
            'productimg' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'diagnostique' => 'required',
            'actions' => 'required'
        ]);
        if(!empty($request->actions)){
            $anomalie->actions()->attach($request->actions);
        } 
        if($request->reparer == 1){
            $anomalie->reparateur_id = $request->reparateur;
            if(!empty($request->productimg)){
                $fileName = "productImage-" . time() . '.' . request()->productimg->getClientOriginalExtension();
                $request->productimg->storeAs('productimg', $fileName);
                $anomalie->productimg = $fileName;
            }
        } 
        $examens = Examen::where('test_id', '=' , $anomalie->test_id )->get();
        $anomalie->diagnostique = $request->diagnostique;        
        $anomalie->step = 4;
        $anomalie->save();
        return view('quality.anomalie.create', compact('anomalie','examens'));
    }

    /*public function removeImage(Request $request)
    {
        $anomalie = $request->session()->get('anomalieS');
        $anomalie->productImg = null;
        return view('anomalie.create-step2',compact('anomalieS', $anomalieS));
    }*/

    public function store(Request $request){
        $anomalie = Anomalie::findOrFail($request->id);
        $request->validate([
            'cause' => 'required',     
            'regles' => 'required'     
        ]);
        if(!empty($request->regles)){
            $anomalie->regles()->attach($request->regles);
        }    
        $anomalie->criticite = $request->criticite;
        /*  notify all users  */
        if(!empty($request->users)){
            foreach($request->users as $user) {
                $alert = new Alert;
                $user = User::findOrFail($user);
                $alert->user_id = $user->id;
                $alert->anomalie_id = $anomalie->id;
                $alert->description = $anomalie->description; 
                $alert->type = "Rappel";
                $alert->save();
            }
        }
        $anomalie->cause = $request->cause;    
        $anomalie->etat = "traité";  
        $anomalie->step = 1;  
        $anomalie->save();   
        $alerts = Alert::where('anomalie_id', '=' , $anomalie->id )->
                whereNotIn('type',['Rappel'])->
                where('etat', '=' , 'en cours' )->get();
        if(!empty($alerts[0])){
            $alerts[0]->etat ="traité";
            $alerts[0]->save();
        }
        return redirect(route('anomalie.dashbord'));
    }

    function generate_pdf() {
        $data = [
            'foo' => 'bar'
        ];
        $pdf = PDF::loadView('pdf.document', $data);
        return $pdf->stream('document.pdf');
    }

    public function delete(Anomalie $anomalie){
        $anomalie->delete();
        return redirect(route('anomalie.dashbord'));
    }
    public function previous(Anomalie $anomalie){
        $anomalie->step-=1;
        if($anomalie->step < 1) $anomalie->step=1;
        $anomalie->save();
        $examens = Examen::where('test_id', '=' , $anomalie->test_id )->get();
        return view('quality.anomalie.create', compact('anomalie','examens'));
    }
}