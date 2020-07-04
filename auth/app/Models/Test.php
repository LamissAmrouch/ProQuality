<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Test extends Model
{
    
    public function examens()
    {
        return $this->hasMany('App\Models\Examen');
    }

    public function inspections()
    {
        return $this->hasMany('App\Models\Inspection');
    }

}
