<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ExamenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('examens')->insert([ 
            'id' => '1',
            'nom' => 'Vitesse de transfert des données en lecture',
            'type' => 'Quantitatif',
            'min' => '90',
            'max' => '93',
            'unite' => 'MB/s',
            'test_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('examens')->insert([ 
            'id' => '2',
            'nom' => 'Vitesse de transfert des données en écriture',
            'type' => 'Quantitatif',
            'min' => '18',
            'max' => '20',
            'unite' => 'MB/s',
            'test_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);
        
        DB::table('examens')->insert([ 
            'id' => '3',
            'nom' => 'Capacité de stockage',
            'type' => 'Quantitatif',
            'min' => '15',
            'max' => '17',
            'unite' => 'Go',
            'test_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('examens')->insert([ 
            'id' => '4',
            'nom' => 'Système de fichier FAT32',
            'type' => 'Qualitatif',
            'test_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('examens')->insert([ 
            'id' => '5',
            'nom' => 'Système de fichier NTFS',
            'type' => 'Qualitatif',
            'test_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('examens')->insert([ 
            'id' => '6',
            'nom' => 'Tension',
            'type' => 'Quantitatif',
            'min' => '249',
            'max' => '251',
            'unite' => 'Volt',
            'test_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('examens')->insert([ 
            'id' => '7',
            'nom' => 'Courant',
            'type' => 'Quantitatif',
            'min' => '9',
            'max' => '11',
            'unite' => 'Ampére',
            'test_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);
        
        DB::table('examens')->insert([ 
            'id' => '8',
            'nom' => 'Puissance',
            'type' => 'Quantitatif',
            'min' => '2000',
            'max' => '2010',
            'unite' => 'Watt',
            'test_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('examens')->insert([ 
            'id' => '9',
            'nom' => 'Résistance de température',
            'type' => 'Quantitatif',
            'min' => '20',
            'max' => '85',
            'unite' => 'Degré',
            'test_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('examens')->insert([ 
            'id' => '10',
            'nom' => 'Longueur du câble',
            'type' => 'Quantitatif',
            'min' => '1',
            'max' => '2',
            'unite' => 'mètre',
            'test_id' => '3',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('examens')->insert([ 
            'id' => '11',
            'nom' => 'Poids du câble',
            'type' => 'Quantitatif',
            'min' => '110',
            'max' => '120',
            'unite' => 'gramme',
            'test_id' => '3',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('examens')->insert([ 
            'id' => '12',
            'nom' => 'Matériel isolation en PVC',
            'type' => 'Qualitatif',
            'test_id' => '3',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('examens')->insert([ 
            'id' => '13',
            'nom' => 'Trois boutons',
            'type' => 'Qualitatif',
            'test_id' => '4',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('examens')->insert([ 
            'id' => '14',
            'nom' => 'Lumière visible',
            'type' => 'Qualitatif',
            'test_id' => '4',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('examens')->insert([ 
            'id' => '15',
            'nom' => 'Molette ordinaire',
            'type' => 'Qualitatif',
            'test_id' => '4',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);
        
        DB::table('examens')->insert([ 
            'id' => '16',
            'nom' => 'Résolution',
            'type' => 'Quantitatif',
            'min' => '1350',
            'max' => '1450',
            'unite' => 'Dpi',
            'test_id' => '4',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('examens')->insert([ 
            'id' => '17',
            'nom' => 'Tension entrée',
            'type' => 'Quantitatif',
            'min' => '100',
            'max' => '240',
            'unite' => 'Volt',
            'test_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);
    
        DB::table('examens')->insert([ 
            'id' => '18',
            'nom' => 'Tension sortie',
            'type' => 'Quantitatif',
            'min' => '5',
            'max' => '10',
            'unite' => 'Volt',
            'test_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);
    

        DB::table('examens')->insert([ 
            'id' => '19',
            'nom' => 'Courant entrée',
            'type' => 'Quantitatif',
            'min' => '1',
            'max' => '2',
            'unite' => 'Ampère',
            'test_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('examens')->insert([ 
            'id' => '20',
            'nom' => 'Courant sortie',
            'type' => 'Quantitatif',
            'min' => '1',
            'max' => '2',
            'unite' => 'Ampère',
            'test_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);
    
        DB::table('examens')->insert([ 
            'id' => '21',
            'nom' => 'Conductivité du cable',
            'type' => 'Quantitatif',
            'min' => '2',
            'max' => '4',
            'unite' => 'Ohms',
            'test_id' => '6',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);
        

        DB::table('examens')->insert([ 
            'id' => '22',
            'nom' => 'Coté A : connecteur USB',
            'type' => 'Qualitatif',
            'test_id' => '6',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('examens')->insert([ 
            'id' => '23',
            'nom' => 'Coté B : connecteur Micro USB',
            'type' => 'Qualitatif',
            'test_id' => '6',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('examens')->insert([ 
            'id' => '24',
            'nom' => 'Vitesse de transfert des données en lecture',
            'type' => 'Quantitatif',
            'min' => '88',
            'max' => '90',
            'unite' => 'MB/s',
            'test_id' => '7',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('examens')->insert([ 
            'id' => '25',
            'nom' => 'Vitesse de transfert des données en écriture',
            'type' => 'Quantitatif',
            'min' => '18',
            'max' => '20',
            'unite' => 'MB/s',
            'test_id' => '7',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);
        
        DB::table('examens')->insert([ 
            'id' => '26',
            'nom' => 'Capacité de stockage',
            'type' => 'Quantitatif',
            'min' => '31',
            'max' => '33',
            'unite' => 'Go',
            'test_id' => '7',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('examens')->insert([ 
            'id' => '27',
            'nom' => 'Système de fichier FAT32',
            'type' => 'Qualitatif',
            'test_id' => '7',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('examens')->insert([ 
            'id' => '28',
            'nom' => 'Système de fichier NTFS',
            'type' => 'Qualitatif',
            'test_id' => '7',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

    }
}
