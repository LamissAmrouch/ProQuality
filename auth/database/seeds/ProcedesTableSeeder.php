<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProcedesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('procedes')->insert([ 
            'id' => '1',
            'designation' => 'Programmation des machines SMT',
            'description' => '',
            'atelier_id' => '1',
            'produit_id' => '7',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('procedes')->insert([ 
            'id' => '2',
            'designation' => 'Programmation des cartes électroniques',
            'description' => '',
            'atelier_id' => '1',
            'produit_id' => '7',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('procedes')->insert([ 
            'id' => '3',
            'designation' => 'Sertissage câble alimentation',
            'description' => '',
            'atelier_id' => '3',
            'produit_id' => '6',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('procedes')->insert([ 
            'id' => '4',
            'designation' => 'Soudage câble alimentation',
            'description' => '',
            'atelier_id' => '3',
            'produit_id' => '6',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('procedes')->insert([ 
            'id' => '5',
            'designation' => 'Emballage câble alimentation',
            'description' => '',
            'atelier_id' => '3',
            'produit_id' => '6',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('procedes')->insert([ 
            'id' => '6',
            'designation' => 'Injection plastique FD',
            'description' => '',
            'atelier_id' => '3',
            'produit_id' => '6',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        
        DB::table('procedes')->insert([ 
            'id' => '7',
            'designation' => 'Injection plastique souris',
            'description' => '',
            'atelier_id' => '2',
            'produit_id' => '3',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('procedes')->insert([ 
            'id' => '8',
            'designation' => 'Injection plastique chargeur',
            'description' => '',
            'atelier_id' => '2',
            'produit_id' => '4',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('procedes')->insert([ 
            'id' => '9',
            'designation' => 'Soudage connecteurs câble USB',
            'description' => '',
            'atelier_id' => '2',
            'produit_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('procedes')->insert([ 
            'id' => '10',
            'designation' => 'Injection PVC câble USB',
            'description' => '',
            'atelier_id' => '2',
            'produit_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('procedes')->insert([ 
            'id' => '11',
            'designation' => 'Emballage câble USB',
            'description' => '',
            'atelier_id' => '2',
            'produit_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('procedes')->insert([ 
            'id' => '12',
            'designation' => 'Montage souris',
            'description' => '',
            'atelier_id' => '4',
            'produit_id' => '3',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        
        DB::table('procedes')->insert([ 
            'id' => '13',
            'designation' => 'Emballage souris',
            'description' => '',
            'atelier_id' => '4',
            'produit_id' => '3',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('procedes')->insert([ 
            'id' => '14',
            'designation' => 'Montage chargeur',
            'description' => '',
            'atelier_id' => '4',
            'produit_id' => '4',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('procedes')->insert([ 
            'id' => '15',
            'designation' => 'Emballage chargeur',
            'description' => '',
            'atelier_id' => '4',
            'produit_id' => '4',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('procedes')->insert([ 
            'id' => '16',
            'designation' => 'Montage FD',
            'description' => '',
            'atelier_id' => '4',
            'produit_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('procedes')->insert([ 
            'id' => '17',
            'designation' => 'Emballage FD',
            'description' => '',
            'atelier_id' => '4',
            'produit_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('procedes')->insert([ 
            'id' => '18',
            'designation' => 'Programmation FD',
            'description' => '',
            'atelier_id' => '5',
            'produit_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('procedes')->insert([ 
            'id' => '19',
            'designation' => 'Emballage RAM',
            'description' => '',
            'atelier_id' => '5',
            'produit_id' => '7',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);


    }
}
