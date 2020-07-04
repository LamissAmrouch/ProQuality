<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'admin',
            'guard_name' => 'web',
            'description' => 'gestion du site entier + privileges utilisateurs (configuration)',
        ]);
        DB::table('roles')->insert([
            'name' => 'gestionnaire',
            'guard_name' => 'web',
            'description' => 'gestion du controle et suivi de la qualité des produits',
        ]);
        DB::table('roles')->insert([
            'name' => 'simple',
            'guard_name' => 'web',
            'description' => 'lanceur d"alerte anomalie produit',
        ]);
    }
}
