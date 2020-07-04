<?php

namespace App\Http\Controllers\Gestionnaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Action;
use App\Models\Anomalie;
use App\Models\Audit;
use Illuminate\Support\Facades\Auth;


class ActionController extends Controller
{
    public function index(){
        $actions = Action::paginate(5);
        return view('quality.action.index',compact('actions'));
    }

    public function create(){ 
        $actionForm = route('action.create');
        return view('quality.action.form', compact('actionForm'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'description' => 'required',
            'designation' => 'required',
            'resultat' => 'required',
            'type' => 'required'
        ]);
        $action = new Action;
        $action->type = $request->type; 
        $action->designation = $request->designation; 
        $action->description = $request->description; 
        $action->resultat = $request->resultat; 
        $action->materiel = $request->materiel; 
        $action->user_id = Auth::user()->id; 
        $action->save();
        if(!empty($request->id)){
            $anomalie = Anomalie::findOrFail($request->id);
            return view('quality.anomalie.create', compact('anomalie'));
        }
        else{
            if( !empty($request->idAudit)){
                $audit = Audit::findOrFail($request->idAudit);
                return view('quality.audit.create', compact('audit'));
            }
            else{
            return redirect(route('action.list'))->with('successMsg',"L'action est ajoutée avec succès");
            }
        }
    }

    public function edit(Action $action){   
        $actionForm = route('action.update', ['action' => $action]);
        return view('quality.action.form',compact('action','actionForm'));
    }

    public function update(Request $request, Action $action){
        $this->validate($request,[
            'description' => 'required',
            'designation' => 'required',
            'resultat' => 'required',
            'type' => 'required'
          ]);
          $action->type = $request->type; 
          $action->designation = $request->designation; 
          $action->description = $request->description; 
          $action->resultat = $request->resultat; 
          $action->materiel = $request->materiel; 
          $action->user_id = Auth::user()->id; 
          $action->save();
          return redirect(route('action.list'))->with('successMsg',"Modification de l'action avec succès");
    }

    public function delete(Action $action){
        $action->delete();
        return redirect(route('action.list'));
    }


}
