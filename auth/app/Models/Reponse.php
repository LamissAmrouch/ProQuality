<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{

    public function examen()
    {
       return $this->belongsTo('App\Models\Examen');
    }

    public function inspection()
    {
       return $this->belongsTo('App\Models\Inspection');
    }
    
}
