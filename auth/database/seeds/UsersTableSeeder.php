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
            'nom' => 'Ouaret',
            'prenom' => 'Nabil',
            'numero_tel' => '+213558',
            'service' => 'SI',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
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
            'nom' => 'Amrouch',
            'prenom' => 'Lamiss',
            'numero_tel' => '+213558757779',
            'service' => 'QHSE',
            'email' => 'fl_amrouch@esi.dz',
            'password' => bcrypt('12345678'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'nom' => 'Reparateur',
            'prenom' => 'Widad',
            'numero_tel' => '+213558878809',
            'service' => 'QHSE',
            'email' => 'fw_dekkiche@esi.dz',
            'password' => bcrypt('12345678'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
