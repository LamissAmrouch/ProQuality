<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caracteristique extends Model
{

    public function produit()
   {
       return $this->belongsTo('App\Models\Produit');
   }

}
