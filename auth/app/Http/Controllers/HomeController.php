<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Alert;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;
use App\User;
use App\Helpers\Helper;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
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
        //dd($toasts);
        $request->session()->put('toasts', $toasts);
        return view('main.accueil');
    }
}
