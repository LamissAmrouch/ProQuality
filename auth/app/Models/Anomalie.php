<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anomalie extends Model
{
   protected $fillable = [
      'titre','description','diagnostique','cause','type'
   ];
    public function regles()
    {
       return $this->belongsToMany('App\Models\Regle');
    }

    public function charges()
    {
        return $this->hasMany('App\Models\Charge');
    }
    
    public function inspections()
    {
        return $this->hasMany('App\Models\Inspection');
    }

    public function fichiers()
    {
        return $this->hasMany('App\Models\Fichier');
    }

    public function attributs()
    {
        return $this->hasMany('App\Models\Attribut');
    }

    public function reparateur()
    {
       return $this->belongsTo('App\User');
    }

    public function test()
    {
       return $this->belongsTo('App\Models\Test');
    } 

    public function lot()
    {
       return $this->belongsTo('App\Models\Lot');
    }

    public function atelier()
    {
       return $this->belongsTo('App\Models\Atelier');
    }

    public function client()
    {
       return $this->belongsTo('App\Models\Client');
    }

    public function fournisseur()
    {
       return $this->belongsTo('App\Models\Fournisseur');
    }

    public function actions()
    {
       return $this->belongsToMany('App\Models\Action');
    }

}

