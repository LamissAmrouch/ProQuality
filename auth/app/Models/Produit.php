<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = [
        'nom' , 'modele', 'reference','description','type','prix'
    ];

    public function caracteristiques()
    {
        return $this->hasMany('App\Models\Caracteristique');
    }
    public function procedes()
    {
        return $this->hasMany('App\Models\Procede');
    }
    public function lots()
    {
        return $this->hasMany('App\Models\Lot');
    } 

    public function fichiers()
    {
        return $this->hasMany('App\Models\Fichier');
    }

    public function regles()
    {
        return $this->hasMany('App\Models\Regle');
    }

    public function audits()
    {
        return $this->hasMany('App\Models\Audit');
    }

}
