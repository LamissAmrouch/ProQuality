<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regle extends Model
{
    public function user(){
       return $this->belongsTo('App\User');
   }

    public function anomalies(){
       return $this->belongsToMany('App\Models\Anomalie');
    }

    public function produit(){
       return $this->belongsTo('App\Models\Produit');
    }
    

}
