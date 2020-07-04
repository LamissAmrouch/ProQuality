<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'name' => 'edit user',
            'guard_name' => 'web',
            'description' => 'droit de modification des utilisateurs, privileges et roles',
        ]);
        DB::table('permissions')->insert([
            'name' => 'view user',
            'guard_name' => 'web',
            'description' => 'droit de voir la liste des utilisateurs',
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit atelier',
            'guard_name' => 'web',
            'description' => 'droit de modification des ateliers',
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit fournisseur',
            'guard_name' => 'web',
            'description' => 'droit de modification des fournisseurs',
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit client',
            'guard_name' => 'web',
            'description' => 'droit de modification des clients',
        ]);
    }
}
