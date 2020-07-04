<?php

namespace App\Imports;

use App\Models\Fournisseur;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FournisseursImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Fournisseur([
            'nom'     => $row['nom'],
            'description'    => $row['description'], 
            'adresse'    => $row['adresse'],         
        ]);
    }
}
