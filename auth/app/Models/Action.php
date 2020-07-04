<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    public function user()
    {
       return $this->belongsTo('App\User');
    }

    public function attributs()
    {
        return $this->hasMany('App\Models\Attribut');
    }

    public function audits()
    {
       return $this->belongsToMany('App\Models\Audit');
    }
    
    public function anomalies()
    {
       return $this->belongsToMany('App\Models\Anomalie');
    }
    
}
