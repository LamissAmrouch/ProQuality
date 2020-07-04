<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    public function audit()
    {
       return $this->belongsTo('App\Models\Audit');
    }
}
