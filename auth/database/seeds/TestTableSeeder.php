<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TestTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('tests')->insert([ 
            'id' => '1',
            'nom' => 'Test de fiabilité FD 3.0 (16 Go)',
            'type' => 'physique',
            'description' => 'Vérifier la fiabilité du flash disque de type 3.0 et capacité 16 Go',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);


        DB::table('tests')->insert([ 
            'id' => '2',
            'nom' => 'Test électronique du câble alimentation',
            'type' => 'électronique',
            'description' => 'Vérifier les caractéristiques électroniques du câble alimentation',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);
         
        DB::table('tests')->insert([ 
            'id' => '3',
            'nom' => 'Test des caracteristiques du câble alimentation',
            'type' => 'physique',
            'description' => 'Vérifier les caractéristiques du câble alimentation',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('tests')->insert([ 
            'id' => '4',
            'nom' => 'Test fonctionel pour souris',
            'type' => 'fonctionel',
            'description' => 'Vérifier les caractéristiques de la souris',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('tests')->insert([ 
            'id' => '5',
            'nom' => 'Test électronique du chargeur',
            'type' => 'électronique',
            'description' => 'Vérifier les caractéristiques électroniques du chargeur',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('tests')->insert([ 
            'id' => '6',
            'nom' => 'Test fonctionel du câble USB',
            'type' => 'fonctionel',
            'description' => 'Vérifier la fonctionnalité du câble USB ',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('tests')->insert([ 
            'id' => '7',
            'nom' => 'Test de fiabilité FD 3.0 (32 Go)',
            'type' => 'physique',
            'description' => 'Vérifier la fiabilité du flash disque de type 3.0 et capacité 32 Go',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

         
        
    }
    
}
