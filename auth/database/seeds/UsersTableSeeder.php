<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => '1',
            'nom' => 'Ouared',
            'prenom' => 'Nabil',
            'numero_tel' => '+213550902696',
            'service' => 'SI',
            'email' => 'admin@digiuslinkalgeria.com',
            'password' => bcrypt('12345678'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'id' => '2',
            'nom' => 'Nacer',
            'prenom' => 'Thinhinane',
            'numero_tel' => '+213560208116',
            'service' => 'Production',
            'email' => 'thinhinane.nacer@digiuslinkalgeria.net',
            'password' => bcrypt('12345678'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'id' => '3',
            'nom' => 'Bendjebbar',
            'prenom' => 'Loubna',
            'numero_tel' => '+213550902702',
            'service' => 'Achat & Stock',
            'email' => 'bendjebbar.loubna@digiuslinkalgeria.net',
            'password' => bcrypt('12345678'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'id' => '4',
            'nom' => 'Mimoune',
            'prenom' => 'Fahima',
            'numero_tel' => '+213550902702',
            'service' => 'Commerciale',
            'email' => 'mimoune.fahima@digiuslinkalgeria.net',
            'password' => bcrypt('12345678'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'id' => '5',
            'nom' => 'Mohamed',
            'prenom' => 'Dzanouni',
            'numero_tel' => '',
            'service' => 'QHSE',
            'email' => 'dzanouni.mohamed@digiuslinkalgeria.net',
            'password' => bcrypt('12345678'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
       
        DB::table('users')->insert([
            'id' => '6',
            'nom' => 'Riche',
            'prenom' => 'Mohamed Walid',
            'numero_tel' => '',
            'service' => 'Réparation',
            'email' => 'riche.mohamed@digiuslinkalgeria.net',
            'password' => bcrypt('12345678'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'id' => '7',
            'nom' => 'Hamraoui',
            'prenom' => 'Yasmine',
            'numero_tel' => '',
            'service' => 'Réparation',
            'email' => 'hamraoui.yasmine@digiuslinkalgeria.net',
            'password' => bcrypt('12345678'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'id' => '8',
            'nom' => 'Slimani',
            'prenom' => 'Nadia',
            'numero_tel' => '',
            'service' => 'Réparation',
            'email' => 'slimani.nadia@digiuslinkalgeria.net',
            'password' => bcrypt('12345678'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);   
    }
}
