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
use App\Exports\AnomaliesExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Auth;

class AnomalieController extends Controller
{
    public function export(){      
        $year = Carbon::now()->format('Y');
        return (new AnomaliesExport($year))->download('Journal des Anomalies '.$year.'.xlsx');
    }

    public function index(){
    	$anomalies = Anomalie::orderBy('id','desc')->paginate(10);
    	return view('quality.anomalie.index',compact('anomalies'));
    }

    public function createFromScratch(Request $request){
        return view('quality.anomalie.create');
    }

    public function createFrom(Request $request, $id){
        $anomalie = Anomalie::findOrFail($id);
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
            'type' => 'required',
            'test' => 'required',
            'quantite' => ['required','integer'],
            'caracteristiquep' => 'required'
        ]);

        if(empty($request->id)){
            $anomalie = new Anomalie();
            $lot_id = DB::table('lots')->insertGetId(
                [   'quantite' => $request->quantite, 
                    'produit_id' => $request->produit,
                    'caracteristiquep' => $request->caracteristiquep
                ]
            ); 
            $anomalie->lot_id = $lot_id;               
        }
        else{
            $anomalie = Anomalie::findOrFail($request->id);
            $lot_id = DB::table('lots')
            ->where('id', $anomalie->lot_id )
            ->update([
                'quantite' => $request->quantite,
                'produit_id' => $request->produit,
                'caracteristiquep' => $request->caracteristiquep
            ]);
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
        if($anomalie->etat != "en cours" && $anomalie->etat != "traité"){
            $anomalie->etat="nouveau";
        } else{
            $anomalie->etat="en cours";
        }
        $anomalie->step = 2;
        $anomalie->save();

        /* Associate an alert if anomaly created from scratch */
        $alerts = Alert::where('anomalie_id', '=' , $anomalie->id )->
                        whereNotIn('type',['Rappel'])->get();
        if(empty($alerts[0])){
            $alert = new Alert;
            $alert->type = $anomalie->type;
            $alert->description = $anomalie->description; 
            switch ($anomalie->type) {
                case 'Retour fournisseur':
                    $alert->fournisseur_id = $anomalie->fournisseur_id;
                    break; 
                case 'Retour client':
                    $alert->client_id = $anomalie->client_id;             
                    break;
                case 'Retour production':
                    $alert->atelier_id = $anomalie->atelier_id;  
                    break;
            }
            $alert->sent = 1;
            $alert->anomalie_id = $anomalie->id; 
            $alert->etat = "en cours";
            $alert->lot_id = $lot_id; 
            $alert->save();
        }

        $examens = Examen::where('test_id', '=' , $anomalie->test_id )->get();
        return view('quality.anomalie.create', compact('anomalie','examens'));
    }

    public function postCreateStep2(Request $request){    
        $anomalie = Anomalie::findOrFail($request->id);
        $result = "Les réponses des examens sont toutes correctes, Aucune erreur detecté";
       
       if (!empty($request->ReponsesEtat)){

            for ($i=0; $i < count($request->ReponsesEtat) ; $i++) { 
                if ($request->ReponsesEtat[$i] =="Incorrect"){
                    $result = "Les réponses des examens ne sont pas toutes correctes, Existence d'une anomalie !";         
                }
                DB::table('reponses')
                ->updateOrInsert(
                    ['anomalie_id' => $anomalie->id, 'examen_id' => $request->ExamensIdd[$i]],
                    ['valeur' => $request->ReponsesValeur[$i] , 
                    'examen_id' => $request->ExamensIdd[$i] ,
                    'anomalie_id' => $anomalie->id,
                    'etat' => $request->ReponsesEtat[$i] ]
                ); 
            }
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

        if($request->reparer == "on" || !empty($anomalie->reparateur_id)){
            $anomalie->reparateur_id = $request->reparateur;
            if(!empty($request->productimg)){
                $fileName = "FR-" . time() . '.' . request()->productimg->getClientOriginalExtension();
                $request->productimg->storeAs('ficheReparation', $fileName);
                $anomalie->productimg = $fileName;
            }
        } else{
            $anomalie->reparateur_id = null;
            $anomalie->productImg = null;
        }

        $examens = Examen::where('test_id', '=' , $anomalie->test_id )->get();
        $anomalie->diagnostique = $request->diagnostique;        
        $anomalie->step = 4;
        $anomalie->save();

        return view('quality.anomalie.create', compact('anomalie','examens'));
    }

    public function store(Request $request){
        $anomalie = Anomalie::findOrFail($request->id);
        $request->validate([
            'cause' => 'required',     
            'criticite' => 'required',     
            'regles' => 'required'     
        ]);
        if(!empty($request->regles)){
            $anomalie->regles()->attach($request->regles);
        }    
        $anomalie->criticite = $request->criticite;
       
        $anomalie->cause = $request->cause;    
        $anomalie->etat = "traité";  
        $anomalie->step = 1;  
        $anomalie->save();   

        /* Update state of alerts */
        $alerts = Alert::where('anomalie_id', '=' , $anomalie->id )->
                whereNotIn('type',['Rappel'])->
                where('etat', '=' , 'en cours' )->get();
        if(!empty($alerts[0])){
            $alerts[0]->etat ="traité";
            $alerts[0]->save();
        }
        return redirect(route('anomalie.dashbord'));
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

    function generate_pdf(Anomalie $anomalie) {
        
        $pdf = PDF::loadView('pdf.ficheAnomalie', compact('anomalie'));
        return $pdf->stream('Fiche.pdf');
    }

    public function view(Anomalie $anomalie){     
        return view('quality.anomalie.view',compact('anomalie'));
    }

}