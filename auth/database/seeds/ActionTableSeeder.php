<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ActionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('actions')->insert([ 
            'id' => '1',
            'type' => 'corrective',
            'designation' => 'Intervention service réparation',
            'description' => 'Réparation des articles défectueux par les réparateurs',
            'resultat' => 'Article mis en état et fonctionnel',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('actions')->insert([ 
            'id' => '2',
            'type' => 'corrective',
            'designation' => 'Intervention service maintenance',
            'description' => 'Maintenance de la machine de production',
            'resultat' => 'Machine en bon état de fonctionnement',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('actions')->insert([ 
            'id' => '3',
            'type' => 'corrective',
            'designation' => 'Arrêter la machine de production',
            'description' => 'Arrêt de la machine afin de diagnostiquer et corriger les problèmes et ensuite réparer la machine',
            'resultat' => 'Machine de production fonctionnelle',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);


        DB::table('actions')->insert([ 
            'id' => '4',
            'type' => 'corrective',
            'designation' => 'Intervention opérateur machine',
            'description' => 'Paramétrage et réglage de la machine de production',
            'resultat' => 'Machine de production paramétrée',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('actions')->insert([ 
            'id' => '5',
            'type' => 'corrective',
            'designation' => 'Instruction et ordres aux ouvriers',
            'description' => 'Donner des instructions aux ouvriers pour les orienter vers les bonnes pratiques de travail',
            'resultat' => 'Travail rigoureux et satisfaisant',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

    }
}
