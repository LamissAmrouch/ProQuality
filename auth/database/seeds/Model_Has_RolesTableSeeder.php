<?php

use Illuminate\Database\Seeder;

class Model_Has_RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('model_has_roles')->insert([
            'role_id' => 1,
            'model_type' => 'App\User',
            'model_id' => 1,
        ]);
        DB::table('model_has_roles')->insert([ /*resp prod est un user simple */
            'role_id' => 3,
            'model_type' => 'App\User',
            'model_id' => 2,
        ]);
        DB::table('model_has_roles')->insert([ /*resp achat est un user simple */
            'role_id' => 3,
            'model_type' => 'App\User',
            'model_id' => 3,
        ]);
        DB::table('model_has_roles')->insert([ /*resp commerciale est un user simple */
            'role_id' => 3,
            'model_type' => 'App\User',
            'model_id' => 4,
        ]);
        DB::table('model_has_roles')->insert([ /*resp QHSE est un user gestionnaire  */
            'role_id' => 2,
            'model_type' => 'App\User',
            'model_id' => 5,
        ]);
        DB::table('model_has_roles')->insert([ /*reparateur est un user simple */
            'role_id' => 3,
            'model_type' => 'App\User',
            'model_id' => 6,
        ]);
        DB::table('model_has_roles')->insert([ /*reparateur est un user simple */
            'role_id' => 3,
            'model_type' => 'App\User',
            'model_id' => 7,
        ]);
        DB::table('model_has_roles')->insert([ /*reparateur est un user simple */
            'role_id' => 3,
            'model_type' => 'App\User',
            'model_id' => 8,
        ]);
    }
}
