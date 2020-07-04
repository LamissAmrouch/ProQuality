<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $this->call(UsersTableSeeder::class);
       $this->call(RolesTableSeeder::class);  
       $this->call(PermissionsTableSeeder::class);  
       $this->call(Model_Has_PermissionsTableSeeder::class);  
       $this->call(Role_Has_PermissionsTableSeeder::class);  
       $this->call(Model_Has_RolesTableSeeder::class);  
       $this->call(AtelierTableSeeder::class);  
       $this->call(ProduitTableSeeder::class);  
       $this->call(CaracteristiqueTableSeeder::class);  
       $this->call(ClientTableSeeder::class);  
       $this->call(FournisseurTableSeeder::class);  
        
    }
}
