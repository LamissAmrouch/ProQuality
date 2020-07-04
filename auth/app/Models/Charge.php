<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    public function anomalie()
    {
       return $this->belongsTo('App\Models\Anomalie');
    }
}
