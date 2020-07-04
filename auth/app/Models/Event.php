<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    
    public function audit()
    {
        return $this->hasOne('App\Models\Audit');
    }

    public function inspection()
    {
        return $this->hasOne('App\Models\Inspection');
    }

    public function alert()
    {
        return $this->hasOne('App\Models\Alert');
    }
    
    public function user()
    {
        return $this->hasOne('App\User');
    }
}
