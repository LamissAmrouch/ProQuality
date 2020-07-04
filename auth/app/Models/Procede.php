<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Procede extends Model
{
    public function atelier()
    {
       return $this->belongsTo('App\Models\Atelier');
    }
    public function produit()
    {
       return $this->belongsTo('App\Models\Produit');
    }

    public function audits()
    {
        return $this->hasMany('App\Models\Audit');
    }
}
