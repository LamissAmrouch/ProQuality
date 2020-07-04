<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{

    public function user()
    {
       return $this->belongsTo('App\User');
    }

    public function procede()
    {
       return $this->belongsTo('App\Models\Procede');
    }

    public function atelier()
    {
       return $this->belongsTo('App\Models\Atelier');
    }

    public function attributs()
    {
        return $this->hasMany('App\Models\Attribut');
    }

    public function actions()
    {
       return $this->belongsToMany('App\Models\Action');
    }

    public function event()
    {
       return $this->belongsTo('App\Models\Event');
    }
    
    public function questionnaires()
    {
        return $this->hasMany('App\Models\Questionnaire');
    }
    
}
