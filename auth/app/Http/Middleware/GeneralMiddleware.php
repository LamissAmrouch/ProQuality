<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use App\Models\Alert;
use App\Models\Event;
use App\Models\Inspection;
use App\Models\Audit;
use App\Helpers\Helper;
use DB;
use Closure;
use Carbon\Carbon;

class GeneralMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if(Auth::user()){
            $this->deleteEventsRelations();
            $this->createEventsAlert();
            $this->displayAlerts($request);
        }
        return $next($request);
    }

    public function deleteEventsRelations(){
        $audits = Audit::all();
        foreach ($audits as $audit) {
            if( count(Event::where('audit_id','=',$audit->id)->get()) == 0 ){
                $audit->delete();
            }
        }

        $inspections = Inspection::all();
        foreach ($inspections as $inspection) {
            if( count(Event::where('inspection_id','=',$inspection->id)->get()) == 0 ){
                $inspection->delete();
            }
        }
    }

    public function createEventsAlert(){
        $eventsARappeler = Event::where('rappel','=','true')->get(); // reduce the for loop
        foreach($eventsARappeler as $event) {
            if($event->alert_id == null){
                $alert= new Alert;
                $alert->type = "Rappel";
                $alert->start = $event->start;
                $alert->user_id = $event->user_id;
                $alert->event_id = $event->id;
                $alert->save();
                $event->alert_id = $alert->id;
                $event->save();
            }
            elseif($event->alert->start != $event->start){
                $event->alert->start = $event->start;
                $event->alert->etat= null;
                $event->alert->save();
            }
        }    
    }

    public function displayAlerts(Request $request){
        $alerts = Alert::where('user_id','=',Auth::user()->id)
                        ->where('sent','=',0)
                        ->whereNotIn('etat', ["en cours","traité"])
                        ->orWhereNull('etat')->get();
        foreach ($alerts as $alert) {
            $currentDate = Carbon::now()->toDateString();
            $currentDateT = Carbon::parse($currentDate)->timestamp;
            $startT = Carbon::parse($alert->start)->timestamp;
            $difference = $startT - $currentDateT;              
            if(($alert->type == "Rappel") && ($difference < 96400)  && ($difference > 3600) )  {
                $alert->etat= "nouveau";
                $alert->save();
            }
            if($alert->type != "Rappel"){
                $alert->sent=1;
                $alert->save();
            }
        }
        $toasts = array();
        $aF = $alerts->where('type','=','Retour fournisseur');
        $aP = $alerts->where('type','=','Retour production');
        $aC = $alerts->where('type','=','Retour client');
        $toasts = array_add($toasts,0, count($aF));  
        $toasts = array_add($toasts,1, count($aP));  
        $toasts = array_add($toasts,2, count($aC));
        $request->session()->put('toasts', $toasts);    
    }
}
