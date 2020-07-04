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
            'nom' => 'fournisseur1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('fournisseurs')->insert([ 
            'id' => '2',
            'nom' => 'fournisseur2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);


        DB::table('fournisseurs')->insert([ 
            'id' => '3',
            'nom' => 'fournisseur3',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

    }
}
