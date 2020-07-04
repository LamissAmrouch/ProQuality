<?php

use Illuminate\Database\Seeder;

class Role_Has_PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Admin can view & edit users */
        DB::table('role_has_permissions')->insert([
            'role_id' => 1,
            'permission_id' => 1,
        ]);
        DB::table('role_has_permissions')->insert([
            'role_id' => 1,
            'permission_id' => 2,
        ]);

        /* gestionnaire & simple user can only view users */
        DB::table('role_has_permissions')->insert([
            'role_id' => 2,
            'permission_id' => 2,
        ]);        
        
        DB::table('role_has_permissions')->insert([
            'role_id' => 3,
            'permission_id' => 2,
        ]);
    }
}
