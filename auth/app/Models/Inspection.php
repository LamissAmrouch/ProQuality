<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    public function user()
    {
       return $this->belongsTo('App\user');
    }

    public function lot()
    {
       return $this->belongsTo('App\Models\Lot');
    }

    public function anomalie()
    {
       return $this->belongsTo('App\Models\Anomalie');
    }

    public function attributs()
    {
        return $this->hasMany('App\Models\Attribut');
    }

    public function reponses()
    {
        return $this->hasMany('App\Models\Reponse');
    }

    public function test()
    {
       return $this->belongsTo('App\Models\Test');
    }
    
    public function event()
    {
       return $this->belongsTo('App\Models\Event');
    }
}
