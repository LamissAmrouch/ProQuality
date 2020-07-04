<?php

namespace App\Http\Controllers\Simple;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Atelier;
use App\Exports\AteliersExport;
use App\Imports\AteliersImport;
use Maatwebsite\Excel\Facades\Excel;


class AtelierController extends Controller
{   
    
    public function export(){
        return Excel::download(new AteliersExport, 'Ateliers.xlsx');
    }
   
    public function import(){
        Excel::import(new AteliersImport,request()->file('file'));
        return back();
    }

    public function index(){
        $ateliers = Atelier::paginate(5);
        return view('simple.atelier.index',compact('ateliers'));
    }

    public function create(){ 
        $actionForm = route('atelier.create');
        return view('simple.atelier.form', compact('actionForm'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'description' => 'required',
            'nom' => 'required',
            'metier' => 'required'
        ]);
        $atelier = new Atelier;
        $atelier->nom = $request->nom; 
        $atelier->metier = $request->metier; 
        $atelier->description = $request->description; 
        $atelier->save();
        return redirect(route('atelier.list'))->with('successMsg',"L'atelier est ajouté avec succès");
    }

    public function edit(Atelier $atelier){   
        $actionForm = route('atelier.update', ['atelier' => $atelier]);
        return view('simple.atelier.form',compact('atelier','actionForm'));
    }

    public function update(Request $request, Atelier $atelier){
        $this->validate($request,[
            'description' => 'required',
            'nom' => 'required',
            'metier' => 'required'
          ]);
          $atelier->nom = $request->nom; 
          $atelier->metier = $request->metier; 
          $atelier->description = $request->description; 
          $atelier->save();
          return redirect(route('atelier.list'))->with('successMsg',"L'atelier est modifié avec succès");
        }

    public function delete(Atelier $atelier){
        $atelier->delete();
        return redirect(route('atelier.list'));
    }
}
