<?php

use Illuminate\Database\Seeder;

class LotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lots')->insert([ 
            'id' => '2',
            'titre' => '',
            'quantite' => '10',
            'caracteristiquep' => '2 m',
            'produit_id' => '10',
        ]);

        DB::table('lots')->insert([ 
            'id' => '1',
            'titre' => '',
            'quantite' => '45',
            'caracteristiquep' => 'Vert',
            'produit_id' => '8',           
        ]);

        DB::table('lots')->insert([ 
            'id' => '3',
            'titre' => '',
            'quantite' => '45',
            'caracteristiquep' => 'Rouge',
            'produit_id' => '11',           
        ]);

        DB::table('lots')->insert([ 
            'id' => '4',
            'titre' => '',
            'quantite' => '20',
            'caracteristiquep' => 'Female',
            'produit_id' => '9',           
        ]);


    }
}
