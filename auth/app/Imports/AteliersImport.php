<?php

namespace App\Imports;

use App\Models\Atelier;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AteliersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Atelier([
            'nom'     => $row['nom'],
            'metier'    => $row['metier'], 
            'description'    => $row['description'], 
        ]);
    }
    
}
