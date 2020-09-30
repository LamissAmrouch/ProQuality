<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FournisseurTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          
        DB::table('fournisseurs')->insert([ 
            'id' => '1',
            'nom' => 'Addad Nabil',
            'description' => '',
            'adresse' => 'Rue Sadani Mohamed Beni Tamou-Blida',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('fournisseurs')->insert([ 
            'id' => '2',
            'nom' => 'Aitcom Pub',
            'description' => '',
            'adresse' => 'place 11 mars, villa N°16 plan de partition N°42, Annaba',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);


        DB::table('fournisseurs')->insert([ 
            'id' => '3',
            'nom' => 'Ben Khrouf Zin',
            'description' => '',
            'adresse' => '89, Lot Vincent II Bouzareah, Alger',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('fournisseurs')->insert([ 
            'id' => '4',
            'nom' => 'Bouhoun Pub',
            'description' => '',
            'adresse' => 'Coopérative el nahda - n 41 Bir Khadem, Alger',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('fournisseurs')->insert([ 
            'id' => '5',
            'nom' => 'DATOTEK',
            'description' => '',
            'adresse' => 'Cité meriem N°07 "A", Baraki Alger',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('fournisseurs')->insert([ 
            'id' => '6',
            'nom' => 'Tebbach Youcef',
            'description' => '',
            'adresse' => 'Bou Ismail, Tipaza',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('fournisseurs')->insert([ 
            'id' => '7',
            'nom' => 'YI DAO HAI NA',
            'description' => '',
            'adresse' => 'Zone activité Zouine Aaba Ali Birtouta -alger',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('fournisseurs')->insert([ 
            'id' => '8',
            'nom' => 'Star Plas',
            'description' => '',
            'adresse' => 'Succursale N° 26 lot eldjanah lakhdar garidi Kouba,Alger',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('fournisseurs')->insert([ 
            'id' => '9',
            'nom' => 'SARL Mouzia',
            'description' => '',
            'adresse' => 'Ain Roumana,Blida',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('fournisseurs')->insert([ 
            'id' => '10',
            'nom' => 'SARL Prtroser',
            'description' => '',
            'adresse' => 'Cheraga,Alger',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('fournisseurs')->insert([ 
            'id' => '11',
            'nom' => 'Kamar Transit',
            'description' => '',
            'adresse' => 'Boulevard du 11 Décembre 1960 ,Lot 65, El Biar',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('fournisseurs')->insert([ 
            'id' => '12',
            'nom' => 'Kenouche Mustapha',
            'description' => '',
            'adresse' => 'Les eucalyptus,Alger',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);


        DB::table('fournisseurs')->insert([ 
            'id' => '13',
            'nom' => 'Koubi Redouane',
            'description' => '',
            'adresse' => 'Baraki,Alger',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

    }
}
