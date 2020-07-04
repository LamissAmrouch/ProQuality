<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    protected $fillable = [
        'nom','description','adresse',
    ];

    public function anomalies()
    {
        return $this->hasMany('App\Models\Anomalie');
    }

    public function alerts()
    {
        return $this->hasMany('App\Models\Alert');
    }
    
}
