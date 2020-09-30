<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('clients')->insert([ 
            'id' => '1',
            'nom' => 'Isra Informatique',
            'description' => '',
            'adresse' => 'BP 09 Oued Smar – Alger',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('clients')->insert([ 
            'id' => '2',
            'nom' => 'Sais Bougara',
            'description' => '',
            'adresse' => '45,chemin Fernane Hanafi, 16040 hussein Dey, Alger',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('clients')->insert([ 
            'id' => '3',
            'nom' => 'BZA Hardware',
            'description' => '',
            'adresse' => 'Cité abdouni boualem lot n° 1, Dar El Beida,Alger',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('clients')->insert([ 
            'id' => '4',
            'nom' => 'H B M',
            'description' => '',
            'adresse' => 'Siège social RN n°5, Cinq Maisons, Mohammadia 16130 Alger',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('clients')->insert([ 
            'id' => '5',
            'nom' => 'NABIL KARA',
            'description' => '',
            'adresse' => 'LOT N° 1 groupe 13 El hamiz, Dar El Beida Alger',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('clients')->insert([ 
            'id' => '6',
            'nom' => 'FATEH STOR',
            'description' => '',
            'adresse' => 'Local N°01 Route de Sebal N°10 El Achour,Alger',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('clients')->insert([ 
            'id' => '7',
            'nom' => 'ISI',
            'description' => '',
            'adresse' => 'Lotissement kaouch Villa N° 8 (deriere AGB Bank) Dely Brahim, Alger',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('clients')->insert([ 
            'id' => '8',
            'nom' => 'HB UNITED',
            'description' => '',
            'adresse' => 'Zone d’activités Mesra, Mostaganem',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('clients')->insert([ 
            'id' => '9',
            'nom' => 'COMPUSTROE',
            'description' => '',
            'adresse' => 'Lotissement boursas villa N°21 HYDRA ALGER',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('clients')->insert([ 
            'id' => '10',
            'nom' => 'RedFabriq',
            'description' => '',
            'adresse' => '89, Lot Vincent II Bouzareah, Alger',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
