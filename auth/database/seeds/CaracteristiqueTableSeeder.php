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
            'nom' => '4 Go',
            'produit_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => '8 Go',
            'produit_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => '16 Go',
            'produit_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => '32 Go',
            'produit_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => '64 Go',
            'produit_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => '16 Go',
            'produit_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => '32 Go',
            'produit_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => '64 Go',
            'produit_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => '128 Go',
            'produit_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => '256 Go',
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
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')       
        ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => '8 GB',
            'produit_id' => '7',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        
        ]);
        DB::table('caracteristiques')->insert([ 
            'nom' => 'Rouge',
            'produit_id' => '8',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        
        ]);
        DB::table('caracteristiques')->insert([ 
            'nom' => 'Vert',
            'produit_id' => '8',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        
        ]);
        DB::table('caracteristiques')->insert([ 
            'nom' => 'Bleu',
            'produit_id' => '8',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        
        ]);
        DB::table('caracteristiques')->insert([ 
            'nom' => 'Male',
            'produit_id' => '9',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        
        ]);
        DB::table('caracteristiques')->insert([ 
            'nom' => 'Female',
            'produit_id' => '9',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        
        ]);
        DB::table('caracteristiques')->insert([ 
            'nom' => '1 m',
            'produit_id' => '10',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        
        ]);
        DB::table('caracteristiques')->insert([ 
            'nom' => '2 m',
            'produit_id' => '10',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        
        ]);
        DB::table('caracteristiques')->insert([ 
            'nom' => '3 m',
            'produit_id' => '10',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        
        ]);
        DB::table('caracteristiques')->insert([ 
            'nom' => 'Rouge',
            'produit_id' => '11',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        
        ]);
        DB::table('caracteristiques')->insert([ 
            'nom' => 'Vert',
            'produit_id' => '11',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        
        ]);
        DB::table('caracteristiques')->insert([ 
            'nom' => 'Bleu',
            'produit_id' => '11',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        
        ]);
        DB::table('caracteristiques')->insert([ 
            'nom' => 'USB 2.0',
            'produit_id' => '12',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        
        ]);
        DB::table('caracteristiques')->insert([ 
            'nom' => 'USB 3.0',
            'produit_id' => '12',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        
        ]);
        DB::table('caracteristiques')->insert([ 
            'nom' => 'RAM DDR',
            'produit_id' => '12',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        
        ]);
        DB::table('caracteristiques')->insert([ 
            'nom' => 'Micro A',
            'produit_id' => '13',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        
        ]);
        DB::table('caracteristiques')->insert([ 
            'nom' => 'Micro C',
            'produit_id' => '13',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        
        ]);
        DB::table('caracteristiques')->insert([ 
            'nom' => 'Micro iPhone',
            'produit_id' => '13',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        
        ]);
        DB::table('caracteristiques')->insert([ 
            'nom' => 'USB A',
            'produit_id' => '13',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        
        ]);
        DB::table('caracteristiques')->insert([ 
            'nom' => 'Rouge',
            'produit_id' => '14',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        
        ]);
        DB::table('caracteristiques')->insert([ 
            'nom' => 'Vert',
            'produit_id' => '14',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        
        ]);
        DB::table('caracteristiques')->insert([ 
            'nom' => 'Bleu',
            'produit_id' => '14',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        
        ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => 'Connecteur USB',
            'produit_id' => '15',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        
        ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => 'Connecteur Micro USB',
            'produit_id' => '15',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        
        ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => 'Connecteur Type C',
            'produit_id' => '15',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        
        ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => 'Connecteur Iphone',
            'produit_id' => '15',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        
        ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => 'PC',
            'produit_id' => '16',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        
        ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => 'Treflle',
            'produit_id' => '16',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        
        ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => 'Onduleur',
            'produit_id' => '16',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        
        ]);

        DB::table('caracteristiques')->insert([ 
            'nom' => 'Catel',
            'produit_id' => '16',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        
        ]);



    }
}
