<?php

namespace App\Http\Controllers\Simple;
use DB;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alert;
use App\Models\Lot;
use App\Models\Produit;
use App\Models\Caracteristique;
use App\Models\Atelier;
use App\Models\Client;
use App\Models\Fournisseur;
use App\Models\Anomalie;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;

class AlertController extends Controller
{
    public function updateRead(Request $request, Alert $alert){
        $alert->etat = "en cours";
        $alert->save();
        return back();
    }

    /*----------------- CRUD alertRF --------------------*/
    public function createRF(){ 
        $action = route('alertRF.create');
        return view('simple.alert.formRF', compact('action'));
    }

    public function storeRF(Request $request){
        $this->validate($request,[
            'fournisseur' => 'required',
            'produit' => 'required',
            'caracteristiquep' => 'required',
            'quantite' => ['required','integer']
        ]);
           
        $alert = new Alert;
        $lot = new Lot;
        $alert->type = 'Retour fournisseur';
        if(!empty($request->description)) {
            $alert->description= $request->description; 
        }
        if(!empty($request->motif)) {
            $alert->motif= $request->motif; 
        }
        $alert->fournisseur_id = $request->fournisseur;
        $lot_id = DB::table('lots')->insertGetId([
            'quantite' => $request->quantite, 
            'caracteristiquep' => $request->caracteristiquep, 
            'produit_id' => $request->produit
            ]); 
        /* notify the QHSE user */
        $users = User::whereHas("roles", function($q){ $q->where("name", "gestionnaire"); })->get();
        $alert->user_id = $users[0]->id;
        $alert->sent = 0;
        $alert->etat = "nouveau";

        /* automaticly create an associated anomaly */
        $anomalie = new Anomalie;
        $anomalie->lot_id = $lot_id;
        $anomalie->fournisseur_id = $request->fournisseur;
        $anomalie->type = 'Retour fournisseur';
        $anomalie->step = 1;
        $anomalie->etat = "nouveau";
        $anomalie->created_at = Carbon::now();
        $anomalie->updated_at = Carbon::now();
        if(!empty($request->description)) {
            $anomalie->description= $request->description; 
        }           
        $anomalie->save();

        $alert->anomalie_id = $anomalie->id; 
        $alert->lot_id = $lot_id; 
        $alert->save();

        if(!empty($request->motif)) {
            $anomalie->titre = $alert->motif. ' N°'.$anomalie->id;
        }
        else{
            $anomalie->titre = '';
        }    
        $anomalie->save(); 

        return redirect(route('alertRF.list'))->with('successMsg',"Création d'une nouvelle alerte");
    }

    public function showRF(){    
        
        $alerts = Alert::where('type', '=',  'Retour fournisseur' )->orderBy('id','desc')->paginate(15);
        return view('simple.alert.listRF',compact('alerts'));
    }

    public function editRF(Alert $alert){   
        $action = route('alertRF.update', ['alert' => $alert]);
        return view('simple.alert.formRF',compact('alert','action'));
    }

    public function updateRF(Request $request, Alert $alert){
        $this->validate($request,[
            'fournisseur' => 'required',
            'produit' => 'required',
            'caracteristiquep' => 'required',
            'quantite' => ['required','integer'],
        ]);
        if(!empty($request->description)) {
            $alert->description= $request->description; 
        }
        else{
            $alert->description= '';
        }

        if(!empty($request->motif)) {
            $alert->motif= $request->motif; 
        }        
        else{
            $alert->motif= '';
        }
        $alert->fournisseur_id = $request->fournisseur;
           
        $update_lot = DB::table('lots')
        ->where('id', $alert->lot_id )
        ->update([
            'quantite' => $request->quantite,             
            'caracteristiquep' => $request->caracteristiquep, 
            'produit_id' => $request->produit
            ]);

        $anomalie = Anomalie::where('id','=',$alert->anomalie_id)->first();
        $anomalie->lot_id = $alert->lot_id;
        $anomalie->fournisseur_id = $request->fournisseur_id;
        $anomalie->type = 'Retour fournisseur';
        $anomalie->step = 1;
        $anomalie->etat = "nouveau";
        $anomalie->created_at = Carbon::now();
        $anomalie->updated_at = Carbon::now();
        if(!empty($request->description)) {
            $anomalie->description= $request->description; 
        }           
        else{
            $anomalie->description = '';
        }     

        if(!empty($request->motif)) {
            $anomalie->titre = $request->motif. ' N°'.$anomalie->id;
        }
        else{
            $anomalie->titre = '';
        }    
        $anomalie->save();

        $alert->save();
        return redirect(route('alertRF.list'))->with('successMsg','Modification alerte réussiée');
    }

    public function deleteRF(Alert $alert){
        DB::table('lots')->where('id', $alert->lot_id )->delete();
        DB::table('anomalies')->where('id', $alert->anomalie_id )->delete();
        $alert->delete();
        return redirect(route('alertRF.list'));
    }
    
    function generate_pdf_RF(Alert $alert) {
        $pdf = PDF::loadView('pdf.ficheRF', compact('alert'));
        return $pdf->stream('Fiche.pdf');
    }
    
    public function viewRF(Alert $alert){     
        return view('simple.alert.viewRF',compact('alert'));
    }

    /*----------------- CRUD alertRC --------------------*/

    public function createRC(){ 
        $action = route('alertRC.create');
        return view('simple.alert.formRC', compact('action'));
    }

    public function storeRC(Request $request){
        $this->validate($request,[
            'client' => 'required',
            'caracteristiquep' => 'required',
            'quantite' => ['required','integer'],
            'produit' => 'required',
        ]);
        $alert = new Alert;
        $lot = new Lot;
        $alert->type = 'Retour client';
        if(!empty($request->description)) {
            $alert->description= $request->description; 
        }
        if(!empty($request->motif)) {
            $alert->motif= $request->motif; 
        }
        $alert->client_id = $request->client;
        /* notify the QHSE user */
        $users = User::whereHas("roles", function($q){ $q->where("name", "gestionnaire"); })->get();
        $alert->user_id = $users[0]->id;
        $alert->sent = 0;
        $alert->etat = "nouveau";

        $lot_id = DB::table('lots')->insertGetId([
            'quantite' => $request->quantite, 
            'produit_id' => $request->produit , 
            'caracteristiquep' => $request->caracteristiquep
        ]); 

        /* automaticly create an associated anomaly */
        $anomalie = new Anomalie;
        $anomalie->lot_id = $lot_id;
        $anomalie->client_id = $request->client;
        $anomalie->type = 'Retour client';
        $anomalie->step = 1;
        $anomalie->etat = "nouveau";
        $anomalie->created_at = Carbon::now();
        $anomalie->updated_at = Carbon::now();
        if(!empty($request->description)) {
            $anomalie->description= $request->description; 
        }           
        $anomalie->save();

        $alert->anomalie_id = $anomalie->id; 
        $alert->lot_id = $lot_id; 
        $alert->save();

        if(!empty($request->motif)) {
            $anomalie->titre = $request->motif. ' N°'.$anomalie->id;
        }
        else{
            $anomalie->titre = '';
        }    
        $anomalie->save();

        return redirect(route('alertRC.list'))->with('successMsg',"Création d'une nouvelle alerte");
    }

    public function showRC(){    
       
        $alerts = Alert::where('type', '=',  'Retour client' )
        ->orderBy('id','desc')->paginate(15);
        return view('simple.alert.listRC',compact('alerts'));
    }

    public function editRC(Alert $alert){   
        $action = route('alertRC.update', ['alert' => $alert]);
        return view('simple.alert.formRC',compact('alert','action'));
    }

    public function updateRC(Request $request, Alert $alert){
        $this->validate($request,[
            'client' => 'required',
            'quantite' => ['required','integer'],
            'produit' => 'required',
            'caracteristiquep' => 'required'
        ]);
           
            $alert->type = 'Retour client';
            if(!empty($request->description)) {
                $alert->description= $request->description; 
            }
            else{
                $alert->description= '';
            }  

            if(!empty($request->motif)) {
                $alert->motif= $request->motif; 
            }
            else{
                $alert->motif= '';
            }
            $alert->client_id = $request->client;
            $alert->sent = 0;

            $update_lot = DB::table('lots')
                ->where('id', $alert->lot_id )
                ->update(['quantite' => $request->quantite, 'produit_id' => $request->produit ,
                'caracteristiquep' => $request->caracteristiquep]);

            $anomalie = Anomalie::where('id','=',$alert->anomalie_id)->first();
            $anomalie->lot_id = $alert->lot_id;
            $anomalie->client_id = $alert->client_id;
            $anomalie->type = 'Retour client';
            $anomalie->step = 1;
            $anomalie->etat = "nouveau";
            if(!empty($request->description)) {
                $anomalie->description= $request->description; 
            }
            else{
                $anomalie->description= '';
            }    

            if(!empty($request->motif)) {
                $anomalie->titre = $request->motif. ' N°'.$anomalie->id;
            }
            else{
                $anomalie->titre = '';
            }    

            $anomalie->save();

            $alert->save();
            return redirect(route('alertRC.list'))->with('successMsg','Modification alerte réussiée');
    }

    public function deleteRC(Alert $alert){
        DB::table('lots')->where('id', $alert->lot_id )->delete();
        DB::table('anomalies')->where('id', $alert->anomalie_id )->delete();
        $alert->delete();
        return redirect(route('alertRC.list'));
    }
    
    public function viewRC(Alert $alert){     
        return view('simple.alert.viewRC',compact('alert'));
    }

    function generate_pdf_RC(Alert $alert){
        $pdf = PDF::loadView('pdf.ficheRC', compact('alert'));
        return $pdf->stream('Fiche.pdf');
    }

    /*----------------- CRUD alertRP --------------------*/

    public function createRP(){ 
      $action = route('alertRP.create');
      return view('simple.alert.formRP', compact('action'));
    }

    public function storeRP(Request $request){
        $this->validate($request,[
             'atelier' => 'required',
             'quantite' => ['required','integer'],
             'produit' => 'required',
             'caracteristiquep' => 'required'
           ]);
           
            $alert = new Alert;
            $lot = new Lot;
            $alert->type = 'Retour production';
            if(!empty($request->description)) {
                $alert->description= $request->description; 
            }
            if(!empty($request->motif)) {
                $alert->motif= $request->motif; 
            }
            $alert->atelier_id = $request->atelier;
            $lot_id = DB::table('lots')->insertGetId(
                ['quantite' => $request->quantite, 'produit_id' => $request->produit ,
                'caracteristiquep' => $request->caracteristiquep]
            ); 

            /* notify the QHSE user */
            $users = User::whereHas("roles", function($q){ $q->where("name", "gestionnaire"); })->get();
            $alert->user_id = $users[0]->id;
            $alert->sent = 0;
            $alert->etat = "nouveau";

            /* automaticly create an associated anomaly */
            $anomalie = new Anomalie;
            $anomalie->lot_id = $lot_id;
            $anomalie->atelier_id = $request->atelier;
            $anomalie->type = 'Retour production';
            $anomalie->step = 1;
            $anomalie->etat = "nouveau";
            $anomalie->created_at = Carbon::now();
            $anomalie->updated_at = Carbon::now();
            if(!empty($request->description)) {
                $anomalie->description= $request->description; 
            }           
            $anomalie->save();
            
            $alert->anomalie_id = $anomalie->id; 
            $alert->lot_id = $lot_id; 
            $alert->save();

            if(!empty($request->motif)) {
                $anomalie->titre = $request->motif. ' N°'.$anomalie->id;
            }
            else{
                $anomalie->titre = '';
            }    

            $anomalie->save();
            return redirect(route('alertRP.list'))->with('successMsg',"Création d'une nouvelle alerte");
    }

    public function showRP(){    
      
        $alerts = Alert::where('type', '=',  'Retour production' )->orderBy('id','desc')->paginate(15);
        return view('simple.alert.listRP',compact('alerts'));
    }

    public function editRP(Alert $alert){   
        $action = route('alertRP.update', ['alert' => $alert]);
        return view('simple.alert.formRP',compact('alert','action'));
    }

    public function updateRP(Request $request, Alert $alert){
        $this->validate($request,[
            'atelier' => 'required',
            'quantite' => ['required','integer'],
            'produit' => 'required',
            'caracteristiquep' => 'required'
        ]);
           
            $alert->type = 'Retour production';
            if(!empty($request->description)) {
                $alert->description= $request->description; 
            }
            else{
                $alert->description= "";
            }
            
            if(!empty($request->motif)) {
                $alert->motif= $request->motif; 
            }
            else{
                $alert->motif= '';
            }
            $alert->atelier_id = $request->atelier;
           
            $update_lot = DB::table('lots')
              ->where('id', $alert->lot_id )
              ->update(['quantite' => $request->quantite, 'produit_id' => $request->produit ,
               'caracteristiquep' => $request->caracteristiquep]);
            
            $anomalie = Anomalie::where('id','=',$alert->anomalie_id)->first();
            $anomalie->lot_id = $alert->lot_id;
            $anomalie->atelier_id = $request->atelier_id;
            $anomalie->type = 'Retour production';
            $anomalie->step = 1;
            $anomalie->etat = "nouveau";
            if(!empty($request->description)) {
                $anomalie->description= $request->description; 
            }     
            else{
                $anomalie->description= '';
            }             
            
            if(!empty($request->motif)) {
                $anomalie->titre = $request->motif. ' N°'.$anomalie->id;
            }
            else{
                $anomalie->titre = '';
            }    

            $anomalie->save();

            $alert->save();
            return redirect(route('alertRP.list'))->with('successMsg','Modification alerte réussiée');
    }

    public function deleteRP(Alert $alert){
        DB::table('lots')->where('id', $alert->lot_id )->delete();
        DB::table('anomalies')->where('id', $alert->anomalie_id )->delete();
        $alert->delete();
        return redirect(route('alertRP.list'));
    }

    function generate_pdf_RP(Alert $alert) {
        
        $pdf = PDF::loadView('pdf.ficheRP', compact('alert'));
        return $pdf->stream('Fiche.pdf');
    }

    public function viewRP(Alert $alert){     
        return view('simple.alert.viewRP',compact('alert'));
    }

}
