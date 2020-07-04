<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{
    public function produit()
   {
       return $this->belongsTo('App\Models\Produit');
   }
   public function anomalies()
   {
       return $this->hasMany('App\Models\Anomalie');
    }

   public function alerts()
   {
       return $this->hasMany('App\Models\Alert');
   }

   public function inspections()
   {
       return $this->hasMany('App\Models\Inspection');
   }
   
}
