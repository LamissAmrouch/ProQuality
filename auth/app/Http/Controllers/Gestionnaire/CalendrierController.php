<?php

namespace App\Http\Controllers\Gestionnaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Inspection;
use App\Models\Alert;
use App\Models\Audit;
use Redirect,Response;
use DB;
use Auth;
use Carbon\Carbon;

class CalendrierController extends Controller
{
    public function index()
    {
        if(request()->ajax()) 
        {
         $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
         $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
 
         $data = Event::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->get(['id','title','type','start', 'end']);
         return Response::json($data);
        }
        return view('quality.calendrier.calender');
    }
    
   
    public function create(Request $request)
    {  
        $type = $request->type;
        $inspection_id = 0;
        $audit_id = 0;
        $event = new Event;
        $event->title = $request->title;
        $event->type = $request->type;
        $event->start = $request->start;
        $event->end = $request->end;
        $event->rappel = $request->rappel;
        $event->user_id = Auth::user()->id;

        if ($type == "Inspection"){
            $inspection_id = DB::table('inspections')->insertGetId(
                ['titre' => $request->title,
                'etat' => "nouveau",
                'step' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),  ]
            );
            $event->inspection_id = $inspection_id;
        }
        else{
            $audit_id = DB::table('audits')->insertGetId(
                ['titre' => $request->title,
                 'etat' => "nouveau",
                 'step' => 1,
                 'created_at' => Carbon::now(),
                 'updated_at' => Carbon::now(), ]
            );
            $event->audit_id = $audit_id;
        }

        $event->save(); 
        return Response::json($event);
    }
     
 
    public function update(Request $request)
    {   
        $where = array('id' => $request->id);
        $updateArr = ['start' => $request->start, 'end' => $request->end];
        $event  = Event::where($where)->update($updateArr);
 
        return Response::json($event);
    } 
 
 
    public function destroy(Request $request)
    {
        $event = Event::where('id',$request->id)->delete();
   
        return Response::json($event);
    }    
 

}
