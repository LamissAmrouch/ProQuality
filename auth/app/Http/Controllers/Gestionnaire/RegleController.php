<?php

namespace App\Http\Controllers\Gestionnaire;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Regle;
use App\Models\User;
use App\Models\Produit;
use Auth;
use App\Models\Anomalie;


class RegleController extends Controller
{
    public function index(){
         
    }

    public function create(){ 
      $action = route('regle.create');
      $produits = Produit::all();
      return view('quality.regle.form', compact('action','produits'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
             'titre' => 'required',
             'produit' => 'required',
             'contenu' => 'required'
        ]);
        $regle = new Regle;
        $regle->titre = $request->titre; 
        $regle->contenu = $request->contenu;
        $regle->user_id = Auth::user()->id; // Id de l'utilisateur authentifié
        if(!empty($request->id)){
            $anomalie = Anomalie::findOrFail($request->id);
            $regle->produit_id = $anomalie->lot->produit->id;
            $regle->save();
            return view('quality.anomalie.create', compact('anomalie'));
        }
        else{
            $regle->produit_id = $request->produit;
            $regle->save();
            return redirect(route('regle.list'))->with('successMsg',"Création d'une nouvelle règle qualité");
        }
    }

    public function show()
    {    
        $regles = Regle::all();
        return view('quality.regle.list',compact('regles'));
    }

    public function edit(Regle $regle)
    {   
        $action = route('regle.update', ['regle' => $regle]);
        $produits = Produit::all();
        return view('quality.regle.form',compact('regle','action','produits'));
    }

    public function update(Request $request, Regle $regle)
    {
        $this->validate($request,[
            'titre' => 'required',
            'produit' => 'required',
            'contenu' => 'required'
          ]);
   
          $regle->titre = $request->titre; 
          $regle->contenu = $request->contenu; 
          $regle->produit_id = $request->produit;
          $regle->user_id = Auth::user()->id; // Id de l'utilisateur authentifié
          $regle->save();
          return redirect(route('regle.list'))->with('successMsg',"Modification de la règle qualité");
    }

    public function delete(Regle $regle)
    {
        $regle->delete();
        return redirect(route('regle.list'));
    }
}
