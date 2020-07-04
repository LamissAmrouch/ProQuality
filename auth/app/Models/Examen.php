<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
   
    public function test()
    {
       return $this->belongsTo('App\Test');
    }

    public function reponse()
    {
        return $this->hasOne('App\Models\Reponse');
    }
    
}
