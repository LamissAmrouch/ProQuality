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
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('ateliers')->insert([ 
            'id' => '2',
            'nom' => 'Injection',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('ateliers')->insert([
            'id' => '3',
            'nom' => 'UPC',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('ateliers')->insert([ 
            'id' => '4',
            'nom' => 'Montage et emballage',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
