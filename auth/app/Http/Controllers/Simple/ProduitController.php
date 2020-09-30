<?php

namespace App\Http\Controllers\Simple;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Procede;
use App\Models\Caracteristique;
use App\Exports\ProduitsExport;
use App\Imports\ProduitsImport;
use Maatwebsite\Excel\Facades\Excel;

class ProduitController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export(){
        return Excel::download(new ProduitsExport, 'Articles.xlsx');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(){
        Excel::import(new ProduitsImport,request()->file('file'));
        return back();
    }

    public function index(){
        return view('simple.produit.index');
    }

    public function create(){ 
        $actionForm = route('produit.create');
        return view('simple.produit.form', compact('actionForm'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'nom' => 'required',
            'modele' => 'required',
            'prix' => 'integer',
            'description' => 'required'
        ]);
        $produit = new Produit;
        $produit->nom = $request->nom; 
        $produit->type = $request->type; 
        $produit->modele = $request->modele; 
        $produit->prix = $request->prix; 
        $produit->description = $request->description;
        $produit->save(); 
        if(!empty($request->nomc)){
            /* insert all caracteristics one by one */
            for ($i=0; $i < count($request->nomc) ; $i++) { 
                $caracteristique = new Caracteristique;
                $caracteristique->nom = $request->nomc[$i]; 
                $caracteristique->produit_id = $produit->id;  
                $caracteristique->save();
            }
        }

        if(!empty($request->designationp)){
            /* insert all procede one by one */
            for ($i=0; $i < count($request->designationp) ; $i++) { 
                $procede = new Procede;
                $procede->designation = $request->designationp[$i]; 
                $procede->description = $request->descriptionp[$i];
                $procede->atelier_id = $request->atelierp[$i];  
                $procede->produit_id = $produit->id;  
                $procede->save();
            }
        }
        return redirect(route('produit.list'))->with('successMsg',"L'article est ajouté avec succès");
    }

    public function edit(Produit $produit){   
        $actionForm = route('produit.update', ['produit' => $produit]);
        return view('simple.produit.form',compact('produit','actionForm'));
    }

    public function update(Request $request, Produit $produit){
        $this->validate($request,[
            'nom' => 'required',
            'modele' => 'required',
            'type' => 'required',
            'prix' => 'integer',
            'description' => 'required'
        ]);
        $produit->nom = $request->nom; 
        $produit->type = $request->type; 
        $produit->modele = $request->modele; 
        $produit->prix = $request->prix; 
        $produit->description = $request->description;
        $produit->save();

        Caracteristique::where('produit_id', $produit->id)->delete();
        if(!empty($request->nomc)){
            /* insert all caracteristics one by one */
            for ($i=0; $i < count($request->nomc) ; $i++) { 
                $caracteristique = new Caracteristique;
                $caracteristique->nom = $request->nomc[$i]; 
                $caracteristique->produit_id = $produit->id;  
                $caracteristique->save();
            }
        }
        
        Procede::where('produit_id', $produit->id)->delete();
        if(!empty($request->designationp)){
            /* insert all procede one by one */
            for ($i=0; $i < count($request->designationp) ; $i++) { 
                $procede = new Procede;
                $procede->designation = $request->designationp[$i]; 
                $procede->description = $request->descriptionp[$i];
                $procede->atelier_id = $request->atelierp[$i];  
                $procede->produit_id = $produit->id;  
                $procede->save();
            }
        }
        return redirect(route('produit.list'))->with('successMsg',"L'article est modifié avec succès");
    }

    public function delete(Produit $produit){
        $produit->delete();
        return redirect(route('produit.list'));
    }
}
