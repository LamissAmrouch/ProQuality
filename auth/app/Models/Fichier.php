<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fichier extends Model
{
    public function user()
    {
       return $this->belongsTo('App\User');
    }

    public function produit()
    {
       return $this->belongsTo('App\Models\Produit');
    }

    public function anomalie()
    {
       return $this->belongsTo('App\Models\Anomalie');
    }


}
