<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    public function lot()
    {
       return $this->belongsTo('App\Models\Lot');
    }
    
    public function anomalie()
    {
       return $this->belongsTo('App\Models\Anomalie');
    }
   
    public function event()
    {
        return $this->belongsTo('App\Models\Event');
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
}
