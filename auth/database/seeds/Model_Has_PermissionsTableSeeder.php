<?php

use Illuminate\Database\Seeder;

class Model_Has_PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('model_has_permissions')->insert([ 
            'permission_id' => 3,
            'model_type' => 'App\User',
            'model_id' => 2,
        ]);
        DB::table('model_has_permissions')->insert([
            'permission_id' => 4,
            'model_type' => 'App\User',
            'model_id' => 3,
        ]);
        DB::table('model_has_permissions')->insert([
            'permission_id' => 5,
            'model_type' => 'App\User',
            'model_id' => 4,
        ]); 
    }
}
