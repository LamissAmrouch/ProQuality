<?php

namespace App\Http\Controllers\Simple;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fournisseur;
use App\Exports\FournisseursExport;
use App\Imports\FournisseursImport;
use Maatwebsite\Excel\Facades\Excel;

class FournisseurController extends Controller
{
        /**
    * @return \Illuminate\Support\Collection
    */
    public function export(){
        return Excel::download(new FournisseursExport, 'fournisseurs.xlsx');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(){
        Excel::import(new FournisseursImport,request()->file('file'));
        return back();
    }

    public function index(){
        $fournisseurs = Fournisseur::paginate(15);
        return view('simple.fournisseur.index',compact('fournisseurs'));
    }

    public function create(){ 
        $actionForm = route('fournisseur.create');
        return view('simple.fournisseur.form', compact('actionForm'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'nom' => 'required',
            'description' => 'required',
            'adresse' => 'required'
        ]);
        $fournisseur = new Fournisseur;
        $fournisseur->nom = $request->nom; 
        $fournisseur->description = $request->description; 
        $fournisseur->adresse = $request->adresse; 
        $fournisseur->save();
        return redirect(route('fournisseur.list'))->with('successMsg',"Le fournisseur est ajouté avec succès");
    }

    public function edit(Fournisseur $fournisseur){   
        $actionForm = route('fournisseur.update', ['fournisseur' => $fournisseur]);
        return view('simple.fournisseur.form',compact('fournisseur','actionForm'));
    }

    public function update(Request $request, Fournisseur $fournisseur){
        $this->validate($request,[
            'nom' => 'required',
            'description' => 'required',
            'adresse' => 'required'
        ]);
        $fournisseur->nom = $request->nom; 
        $fournisseur->description = $request->description; 
        $fournisseur->adresse = $request->adresse; 
        $fournisseur->save();
        return redirect(route('fournisseur.list'))->with('successMsg',"Le fournisseur est modifié avec succès");
    }

    public function delete(Fournisseur $fournisseur){
        $fournisseur->delete();
        return redirect(route('fournisseur.list'));
    }
}
