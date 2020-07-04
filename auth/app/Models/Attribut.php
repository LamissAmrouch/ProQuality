<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribut extends Model
{

    public function anomalie()
    {
       return $this->belongsTo('App\Models\Anomalie');
    }

    public function audit()
    {
       return $this->belongsTo('App\Models\Audit');
    }

    public function inspection()
    {
       return $this->belongsTo('App\Models\Inspection');
    }

    public function action()
    {
       return $this->belongsTo('App\Models\Action');
    }
    
}
