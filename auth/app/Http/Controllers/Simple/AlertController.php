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
             'description' => 'required',
             'fournisseur' => 'required',
             'produit' => 'required',
             'quantite' => ['required','integer'],
             'motif'  => 'required'
           ]);
           
           $alert = new Alert;
           $lot = new Lot;
           $alert->type = 'Retour fournisseur';
           $alert->description = $request->description; 
           $alert->fournisseur_id = $request->fournisseur;
           $alert->motif = $request->motif;
           $lot_id = DB::table('lots')->insertGetId(
            ['quantite' => $request->quantite, 'produit_id' => $request->produit]
           ); 
           /* notify the QHSE user */
           $users = User::whereHas("roles", function($q){ $q->where("name", "gestionnaire"); })->get();
           $alert->user_id = $users[0]->id;
           $alert->sent = 0;
           $alert->etat = "nouveau";

           /* automaticly create an associated anomaly */
           $anomalie_id = DB::table('anomalies')->insertGetId([   
                'lot_id' => $lot_id,
                'fournisseur_id' => $alert->fournisseur_id,
                'type' => $alert->type,         
                'description' => $alert->description,         
                'step' => 1, 
                'etat' => "nouveau",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),   
            ]); 
           $alert->anomalie_id = $anomalie_id; 
           $alert->lot_id = $lot_id; 
           $alert->save();
           return redirect(route('alertRF.list'))->with('successMsg',"Création d'une nouvelle alerte");
    }

    public function showRF(){    
        $alerts = Alert::where('type', '=' , 'Retour fournisseur' )->get();
        return view('simple.alert.listRF',compact('alerts'));
    }

    public function editRF(Alert $alert){   
        $action = route('alertRF.update', ['alert' => $alert]);
        return view('simple.alert.formRF',compact('alert','action'));
    }

    public function updateRF(Request $request, Alert $alert){
        $this->validate($request,[
            'description' => 'required',
            'fournisseur' => 'required',
            'produit' => 'required',
            'quantite' => ['required','integer'],
            'motif'  => 'required'
          ]);
   
           $alert->description = $request->description; 
           $alert->fournisseur_id = $request->fournisseur;
           $alert->motif = $request->motif;
           
           $update_lot = DB::table('lots')
              ->where('id', $alert->lot_id )
              ->update(['quantite' => $request->quantite, 'produit_id' => $request->produit]);
            
            
            $anomalie_id = DB::table('anomalies')
            ->where('id', $alert->anomalie_id )
            ->update([
                'lot_id' => $alert->lot_id,
                'fournisseur_id' => $alert->fournisseur_id,
                'type' => $alert->type,         
                'description' => $alert->description,
                'step' => 1, 
                'etat' => "nouveau",
            ]);

           $alert->save();
           return redirect(route('alertRF.list'))->with('successMsg','Modification alerte réussiée');
    }

    public function deleteRF(Alert $alert){
        $alert->delete();
        return redirect(route('alertRF.list'));
    }

    /*----------------- CRUD alertRC --------------------*/

    public function createRC(){ 
      $action = route('alertRC.create');
      return view('simple.alert.formRC', compact('action'));
    }

    public function storeRC(Request $request){
        $this->validate($request,[
             'client' => 'required',
             'description' => 'required',
             'motif' => 'required',
             'quantite' => ['required','integer'],
             'produit' => 'required',
             'caracteristiquep' => 'required'
           ]);
           
           $alert = new Alert;
           $lot = new Lot;
           $alert->type = 'Retour client';
           $alert->description = $request->description; 
           $alert->client_id = $request->client;
           $alert->motif = $request->motif;
           /* notify the QHSE user */
           $users = User::whereHas("roles", function($q){ $q->where("name", "gestionnaire"); })->get();
           $alert->user_id = $users[0]->id;
           $alert->sent = 0;
           $alert->etat = "nouveau";

           $lot_id = DB::table('lots')->insertGetId(
            ['quantite' => $request->quantite, 'produit_id' => $request->produit , 
            'caracteristiquep' => $request->caracteristiquep]
           ); 

            /* automaticly create an associated anomaly */
           $anomalie_id = DB::table('anomalies')->insertGetId([   
                'lot_id' => $lot_id,
                'client_id' => $alert->client_id,
                'type' => $alert->type,         
                'description' => $alert->description,   
                'step' => 1,
                'etat' => "nouveau",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),           
            ]); 
           $alert->anomalie_id = $anomalie_id; 

           $alert->lot_id = $lot_id; 
           $alert->save();
           return redirect(route('alertRC.list'))->with('successMsg',"Création d'une nouvelle alerte");
    }

    public function showRC(){    
        $alerts = Alert::where('type', '=' , 'Retour client' )->get();
        return view('simple.alert.listRC',compact('alerts'));
    }

    public function editRC(Alert $alert){   
        $action = route('alertRC.update', ['alert' => $alert]);
        return view('simple.alert.formRC',compact('alert','action'));
    }

    public function updateRC(Request $request, Alert $alert){
        $this->validate($request,[
            'client' => 'required',
            'description' => 'required',
            'motif' => 'required',
            'quantite' => ['required','integer'],
            'produit' => 'required',
            'caracteristiquep' => 'required'
          ]);
           
           $alert->type = 'Retour client';
           $alert->description = $request->description; 
           $alert->client_id = $request->client;
           $alert->motif = $request->motif;
           $alert->sent = 0;

           $update_lot = DB::table('lots')
              ->where('id', $alert->lot_id )
              ->update(['quantite' => $request->quantite, 'produit_id' => $request->produit ,
               'caracteristiquep' => $request->caracteristiquep]);
        
            $anomalie_id = DB::table('anomalies')
            ->where('id', $alert->anomalie_id )
            ->update([
                'lot_id' => $alert->lot_id,
                'client_id' => $alert->client_id,
                'type' => $alert->type,         
                'description' => $alert->description,
                'step' => 1,
                'etat' => "nouveau",
            ]);

           $alert->save();
           return redirect(route('alertRC.list'))->with('successMsg','Modification alerte réussiée');
    }

    public function deleteRC(Alert $alert){
        $alert->delete();
        return redirect(route('alertRC.list'));
    }

    /*----------------- CRUD alertRP --------------------*/

    public function createRP(){ 
      $action = route('alertRP.create');
      return view('simple.alert.formRP', compact('action'));
    }

    public function storeRP(Request $request){
        $this->validate($request,[
             'atelier' => 'required',
             'description' => 'required',
             'motif' => 'required',
             'quantite' => ['required','integer'],
             'produit' => 'required',
             'caracteristiquep' => 'required'
           ]);
           
           $alert = new Alert;
           $lot = new Lot;
           $alert->type = 'Retour production';
           $alert->description = $request->description; 
           $alert->atelier_id = $request->atelier;
           $alert->motif = $request->motif;
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
           $anomalie_id = DB::table('anomalies')->insertGetId([   
                'lot_id' => $lot_id,
                'atelier_id' => $alert->atelier_id,
                'type' => $alert->type,         
                'description' => $alert->description,  
                'etat' => "nouveau",
                'step' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),            
            ]); 
           $alert->anomalie_id = $anomalie_id; 

           $alert->lot_id = $lot_id; 
           $alert->save();
           return redirect(route('alertRP.list'))->with('successMsg',"Création d'une nouvelle alerte");
    }

    public function showRP(){    
        $alerts = Alert::where('type', '=' , 'Retour production' )->get();
        return view('simple.alert.listRP',compact('alerts'));
    }

    public function editRP(Alert $alert){   
        $action = route('alertRP.update', ['alert' => $alert]);
        return view('simple.alert.formRP',compact('alert','action'));
    }

    public function updateRP(Request $request, Alert $alert){
        $this->validate($request,[
            'atelier' => 'required',
            'description' => 'required',
            'motif' => 'required',
            'quantite' => ['required','integer'],
            'produit' => 'required',
            'caracteristiquep' => 'required'
          ]);
           
           $alert->type = 'Retour production';
           $alert->description = $request->description; 
           $alert->atelier_id = $request->atelier;
           $alert->motif = $request->motif;
           
           $update_lot = DB::table('lots')
              ->where('id', $alert->lot_id )
              ->update(['quantite' => $request->quantite, 'produit_id' => $request->produit ,
               'caracteristiquep' => $request->caracteristiquep]);
        
            $anomalie_id = DB::table('anomalies')
            ->where('id', $alert->anomalie_id )
            ->update([
                'lot_id' => $alert->lot_id,
                'atelier_id' => $alert->atelier_id,
                'type' => $alert->type,         
                'description' => $alert->description,                
                'step' => 1,
                'etat' => "nouveau",
            ]);
           
           $alert->save();
           return redirect(route('alertRP.list'))->with('successMsg','Modification alerte réussiée');
    }

    public function deleteRP(Alert $alert){
        $alert->delete();
        return redirect(route('alertRP.list'));
    }
}
