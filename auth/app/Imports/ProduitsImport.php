<?php

namespace App\Imports;

use App\Models\Produit;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProduitsImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Produit([
            'nom'     => $row['nom'],
            'modele'    => $row['modele'], 
            'reference'    => $row['reference'], 
            'description'    => $row['description'], 
            'type'    => $row['type'], 
            'prix'    => $row['prix'],     
        ]);
    }
}
