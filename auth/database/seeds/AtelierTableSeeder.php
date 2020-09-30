<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AtelierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ateliers')->insert([ 
            'id' => '1',
            'nom' => 'SMT',
            'metier' => 'Production des cartes électroniques pour la RAM et flashs disques',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('ateliers')->insert([ 
            'id' => '2',
            'nom' => 'Injection',
            'metier' => 'Injection plastique pour la souris,chargeurs et flashs disques',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('ateliers')->insert([
            'id' => '3',
            'nom' => 'Unité Production Câble',
            'metier' => 'Production des câbles alimenations et câbles USB',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('ateliers')->insert([ 
            'id' => '4',
            'nom' => 'Montage et emballage',
            'metier' => 'Monatge des souris et chargeurs ainsi que emballages de tous les produits',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('ateliers')->insert([ 
            'id' => '5',
            'nom' => 'Contrôle',
            'metier' => 'Test et contrôle des produits en cours de lors fabrication et les produits finis',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
