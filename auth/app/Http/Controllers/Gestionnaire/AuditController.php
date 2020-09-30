<?php

namespace App\Http\Controllers\Gestionnaire;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lot;
use App\Models\Test;
use App\Models\Audit;
use App\Models\Alert;
use App\Models\Event;
use App\Models\Produit;
use App\Models\Examen;
use App\Models\Reponse;
use App\Models\Questionnaire;
use Auth;
use Redirect,Response;
use PDF;
use Carbon\Carbon;
use App\Exports\AuditsExport;
use Maatwebsite\Excel\Facades\Excel;

class AuditController extends Controller
{

    public function export(){      
        $year = Carbon::now()->format('Y');
        return (new AuditsExport($year))->download('Journal des audits '.$year.'.xlsx');
    }

    public function index(){
    	$audits = Audit::orderBy('id','desc')->paginate(10);
    	return view('quality.audit.index',compact('audits'));
    }
    
    public function createFrom(Request $request, $id){
        $event = Event::findOrFail($id);
        $event->rappel = "false"; // update rappel variable
        $event->save();
        $audit = Audit::where('id', '=' , $event->audit_id)->first();
  
        if($event->alert != null){
            $event->alert->etat ="en cours";
            $event->alert->save();
        }
        return view('quality.audit.create', compact('audit'));
    }

    public function create(Request $request){   
        return view('quality.audit.create');
    }

    public function postCreateStep1(Request $request){   
        if(empty($request->id)){
            $audit = new audit(); 
        }
        else{
            $audit = audit::findOrFail($request->id);
            $update_lot = DB::table('events')
                ->where('audit_id', $audit->id )
                ->update(['title' => $audit->titre, 'start' => $request->date , 
                'end' => $request->date]); 
        }

        $request->validate([
            'titre' => 'required',
            'date' => 'required',
            'description' => 'required',
            'procede' => 'required'
        ]);

        $audit->titre = $request->titre;
        $audit->description = $request->description;
        $audit->procede_id = $request->procede;
        $audit->user_id = Auth::user()->id; // Id de l'utilisateur authentifie
       
        $audit->etat = "nouveau";   
        $audit->step = 2;
        $audit->save();

        if(empty($request->id)){

            $event = new Event();
            $event->title = $audit->titre;
            $event->start = $request->date;
            $event->end = $request->date;
            $event->type = 'Audit';
            $event->audit_id = $audit->id;
            $event->save();      
        }
     
         
        return view('quality.audit.create',compact('audit'));    
    }

    public function postCreateStep2(Request $request){    
        $audit = Audit::findOrFail($request->id);   
        Questionnaire::where('audit_id', $audit->id )->delete();    
        
        if (!empty($request->IdQ) ){
          for ($i=0; $i < count($request->IdQ) ; $i++) {
            if ( !empty($request->IdQ[$i]) ){
               DB::table('questionnaires')
               ->updateOrInsert(
               ['audit_id' =>  $audit->id , 'id' => $request->IdQ[$i] ],
               ['question' => $request->questions[$i], 
                'reponse' => $request->reponses[$i],
                'remarque' => $request->remarques[$i],
                'audit_id' => $audit->id ]
               ); 
            }
            else{
              $questionnaire = new Questionnaire();
              $questionnaire->question = $request->questions[$i];
              $questionnaire->reponse = $request->reponses[$i];
              $questionnaire->remarque = $request->remarques[$i];
              $questionnaire->audit_id = $audit->id;
              $questionnaire->save();
            }
          }
        }
        $audit->etat = "en cours";   
        $audit->step = 3;
        $audit->save();
        return view('quality.audit.create',compact('audit'));
    }

    public function store(Request $request)
    {
        $audit = audit::findOrFail($request->id);
        $request->validate([
            'resultats' => 'required'
        ]);

        if(!empty($request->actions)){
            $audit->actions()->attach($request->actions);
        } 
        if(!empty($request->regles)){
            $audit->regles()->attach($request->regles);
        }  

        $audit->resultats = $request->resultats; 

        if (!empty($request->commentaire)){
            $audit->commentaire = $request->commentaire; 
        }
        $audit->etat = "traité";   
        $audit->step = 1;
        $audit->save();
        return redirect(route('audit.dashbord'))->with('successMsg',"Création d'un nouveau audit");
    }

    public function delete(Audit $audit){
        $audit->delete();
        return redirect(route('audit.dashbord'));    
    }

    public function deleteQ(Request $request, Questionnaire $questionnaire){   
        $audit = Audit::findOrFail($request->id);
        $audit->step = 3;
        $audit->save();
        $questionnaire->delete();
        return redirect(route('audit.create-step2'));  
       // return view('quality.audit.create',compact('audit'));
    }

    public function previous(Audit $audit){
        $audit->step -= 1;  
        if($audit->step < 1) $audit->step = 1;  
        $audit->save();
        return view('quality.audit.create', compact('audit'));
    }

    public function edit(Audit $audit){        
        $audit->step = 1; 
        $audit->etat = "en cours";  
        return view('quality.audit.create',compact('audit')); 
    }

    function generate_pdf(Audit $audit) {
        
        $pdf = PDF::loadView('pdf.ficheAudit', compact('audit'));
        return $pdf->stream('Fiche.pdf');
    }

    public function view(Audit $audit){     
        return view('quality.audit.view',compact('audit'));
    }


}
