<?php

namespace App\Http\Controllers\Gestionnaire;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Examen;
use App\Models\Test;


class TestController extends Controller
{
    public function index(){
         
    }

    public function create(Request $request){ 
        $action = route('test.create');
        return view('quality.test.form', compact('action'));
    }

    public function store(Request $request){
        $this->validate($request,[
             'description' => 'required',
             'nom' => 'required',
             'type' => 'required'
           ]);
        $test = new Test;
        $test->type = $request->type; 
        $test->nom = $request->nom; 
        $test->description = $request->description; 
        $test->save();
        
       if (!empty($request->nomE))
       {
        /* insert all exams one by one */
        for ($i=0; $i < count($request->nomE) ; $i++) { 
            $examen = new Examen;
            $examen->type = $request->typeE[$i]; 
            $examen->nom = $request->nomE[$i];
            $examen->test_id = $test->id;  // after test is inserted u can access his id

            if ($examen->type == "Quantitatif"){          
                 $examen->min = $request->min[$i];
                 $examen->max = $request->max[$i];
                 $examen->unite = $request->unite[$i]; 
            }
           /* if ($examen->type == "Qualitatif"){
                $examen->reponse1 = $request->reponse[$i];
                $examen->reponse2 = $request->reponseTwo[$i];
            }*/
            $examen->save();
        }
       }

        return redirect()->route('test.list')->with('successMsg',"Création d'un nouveau test");             
    }

    public function show(){    
        $tests = Test::all();
        return view('quality.test.list',compact('tests'));
    }

    public function edit(Test $test){          
        $action = route('test.update', ['test' => $test]);
        return view('quality.test.form',compact('test','action'));
    }

    public function update(Request $request, Test $test){
        $this->validate($request,[
            'description' => 'required',
            'nom' => 'required',
            'type' => 'required'
        ]);
   
        $test->type = $request->type; 
        $test->nom = $request->nom; 
        $test->description = $request->description; 
        $test->save();
        Examen::where('test_id', $test->id)->delete();
        /* insert all exams one by one */
        if (!empty($request->nomE)){
            for ($i=0; $i < count($request->nomE) ; $i++) { 
              $examen = new Examen;
              $examen->type = $request->typeE[$i]; 
              $examen->nom = $request->nomE[$i];
              $examen->test_id = $test->id;  // after test is inserted u can access his id
  
              if ($examen->type == "Quantitatif"){          
                   $examen->min = $request->min[$i];
                   $examen->max = $request->max[$i];
                   $examen->unite = $request->unite[$i]; 
              }
             /* if ($examen->type == "Qualitatif"){
                   $examen->reponse1 = $request->reponse[$i];
                   $examen->reponse2 = $request->reponseTwo[$i];
              }*/
              $examen->save();
            }
        }
          
          return redirect(route('test.list'))->with('successMsg',"Modification du test");
    }

    public function delete(Test $test){
        $test->delete();
        return redirect(route('test.list'));
    }

    public function storeExamen(Request $request){   
        $type = $request->typeE;
           
           if ( $type == "Quantitatif"){
                $this->validate($request,[
                    'min' => 'required',
                    'max' => 'required',
                    'unite' => 'required'     
                ]);
            
                $examen = new Examen;
                $examen->type = $request->typeE; 
                $examen->nom = $request->nomE; 
                $examen->min = $request->min;
                $examen->max = $request->max;
                $examen->unite = $request->unite; 
                $examen->test_id = $test_id; 
                $examen->save();
                return redirect(route('test.create'));
         
           }
           if ( $type == "Qualitatif")
           {
                $examen = new Examen;
                $examen->type = $request->typeE; 
                $examen->nom = $request->nomE; 
                $examen->reponse = $request->reponse;
                $examen->test_id = $test_id; 
                $examen->save();
                return redirect(route('test.create'));
           }
           
    }
}
