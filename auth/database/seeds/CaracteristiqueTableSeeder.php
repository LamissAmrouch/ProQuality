<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;


class CaracteristiqueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('caracteristiques')->insert([ 
            'nom' => '4 GB',
            'produit_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => '8 GB',
            'produit_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => '16 GB',
            'produit_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => '32 GB',
            'produit_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => '64 GB',
            'produit_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => '16 GB',
            'produit_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => '32 GB',
            'produit_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => '64 GB',
            'produit_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => '128 GB',
            'produit_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => '256 GB',
            'produit_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);
      
        DB::table('caracteristiques')->insert([ 
            'nom' => 'Sans fils',
            'produit_id' => '3',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);
        
        DB::table('caracteristiques')->insert([ 
            'nom' => 'Filaire',
            'produit_id' => '3',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => 'Rapide adaptative',
            'produit_id' => '4',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);
        
        DB::table('caracteristiques')->insert([ 
            'nom' => 'Type C',
            'produit_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => 'Luna',
            'produit_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => 'Iphone',
            'produit_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);
       
        DB::table('caracteristiques')->insert([ 
            'nom' => 'PC',
            'produit_id' => '6',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);
        DB::table('caracteristiques')->insert([ 
            'nom' => 'LAPTOP',
            'produit_id' => '6',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => 'Onduleur',
            'produit_id' => '6',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => '2 GB',
            'produit_id' => '7',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        
            ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => '4 GB',
            'produit_id' => '7',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => '8 GB',
            'produit_id' => '7',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        ]);
    }
}
