<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atelier extends Model
{   
    protected $fillable = [
        'nom' , 'metier', 'description'
    ];

    public function audits()
    {
        return $this->hasMany('App\Models\Audit');
    }
    public function procedes()
    {
        return $this->hasMany('App\Models\Procede');
    }
    public function anomalies()
    {
        return $this->hasMany('App\Models\Anomalie');
    }

    public function alerts()
    {
        return $this->hasMany('App\Models\Alert');
    }
}
