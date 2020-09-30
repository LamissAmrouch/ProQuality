<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProduitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produits')->insert([ 
            'id' => '1',
            'nom' => 'Flash disque 2.0',
            'type' => 'Fini',
            'modele' => 'MANHATTAN',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('produits')->insert([ 
            'id' => '2',
            'nom' => 'Flash disque 3.0',
            'type' => 'Fini',
            'modele' => 'MANHATTAN',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('produits')->insert([ 
            'id' => '3',
            'nom' => 'Souris',
            'modele' => 'AS47',
            'type' => 'Fini',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('produits')->insert([ 
            'id' => '4',
            'nom' => 'Chargeur',
            'modele' => 'DIAMOND',
            'type' => 'Fini',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('produits')->insert([ 
            'id' => '5',
            'nom' => 'Câble USB',
            'modele' => 'CBL3IP',
            'type' => 'Fini',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('produits')->insert([ 
            'id' => '6',
            'nom' => 'Câble alimentation',
            'modele' => 'CEA',
            'type' => 'Fini',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('produits')->insert([ 
            'id' => '7',
            'nom' => 'RAM DDR3',
            'modele' => 'DDRIII',
            'type' => 'Fini',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('produits')->insert([ 
            'id' => '8',
            'nom' => 'ABS',
            'type' => 'Matiere premiere',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);
        
        DB::table('produits')->insert([ 
            'id' => '9',
            'nom' => '3P plug',
            'type' => 'Matiere premiere',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('produits')->insert([ 
            'id' => '10',
            'nom' => 'Cable blanc',
            'type' => 'Matiere premiere',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('produits')->insert([ 
            'id' => '11',
            'nom' => 'PVC',
            'type' => 'Matiere premiere',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('produits')->insert([ 
            'id' => '12',
            'nom' => 'PCBA',
            'type' => 'Matiere premiere',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('produits')->insert([ 
            'id' => '13',
            'nom' => 'Connecteur USB',
            'type' => 'Semi-fini',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('produits')->insert([ 
            'id' => '14',
            'nom' => 'Couvercle souris',
            'type' => 'Semi-fini',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('produits')->insert([ 
            'id' => '15',
            'nom' => 'Connecteur',
            'type' => 'Matiere premiere',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('produits')->insert([ 
            'id' => '16',
            'nom' => 'Câble',
            'type' => 'Matiere premiere',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);


    }
}
