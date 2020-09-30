<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RegleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('regles')->insert([ 
            'id' => '1',
            'titre' => 'Compatibilité',
            'contenu' => 'toutes les versions de Windows, Mac Os version 10.4 ou version ultérieure, Linux Kernel 2.6 ou version ultérieure',
            'produit_id' => '3',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('regles')->insert([ 
            'id' => '2',
            'titre' => 'Protocole USB',
            'contenu' => 'USB 2.0',
            'produit_id' => '3',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('regles')->insert([ 
            'id' => '3',
            'titre' => 'Résolution',
            'contenu' => '1400 Dpi',
            'produit_id' => '3',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('regles')->insert([ 
            'id' => '4',
            'titre' => 'Nombre de boutons',
            'contenu' => '3',
            'produit_id' => '3',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);


        DB::table('regles')->insert([ 
            'id' => '5',
            'titre' => 'Capteur',
            'contenu' => 'Type : optique, Lumiére visible : Oui, Couleur de la lumière : rouge',
            'produit_id' => '3',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);


        DB::table('regles')->insert([ 
            'id' => '6',
            'titre' => 'Longeur cable',
            'contenu' => '1,3 métres',
            'produit_id' => '3',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);


        DB::table('regles')->insert([ 
            'id' => '7',
            'titre' => 'Molette',
            'contenu' => 'Ordinaire',
            'produit_id' => '3',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('regles')->insert([ 
            'id' => '8',
            'titre' => 'Dimensions',
            'contenu' => '67 mm x 117 mm x 35 mm',
            'produit_id' => '3',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('regles')->insert([ 
            'id' => '9',
            'titre' => 'Poids',
            'contenu' => '85 grs',
            'produit_id' => '3',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('regles')->insert([ 
            'id' => '10',
            'titre' => 'Type de connexion',
            'contenu' => 'Connectivité avancée sans fils 2,4 GHz',
            'produit_id' => '3',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('regles')->insert([ 
            'id' => '11',
            'titre' => 'Interface de connexion',
            'contenu' => 'Récepteur USB',
            'produit_id' => '3',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('regles')->insert([ 
            'id' => '12',
            'titre' => 'Distance de travail',
            'contenu' => '10 Métres',
            'produit_id' => '3',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('regles')->insert([ 
            'id' => '13',
            'titre' => 'Compatibilité',
            'contenu' => 'Toutes les appareils avec un cable USB',
            'produit_id' => '4',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('regles')->insert([ 
            'id' => '14',
            'titre' => 'Dimensions',
            'contenu' => '8 cm x 3,8 cm x 2,5 cm',
            'produit_id' => '4',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('regles')->insert([ 
            'id' => '15',
            'titre' => 'Poids',
            'contenu' => '20 grs',
            'produit_id' => '4',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('regles')->insert([ 
            'id' => '16',
            'titre' => 'Puissance',
            'contenu' => 'Sortie : 5V, 2.1A et Entrée : 100-240V , 0.5A',
            'produit_id' => '4',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);
        
        DB::table('regles')->insert([ 
            'id' => '17',
            'titre' => 'Compatibilité',
            'contenu' => 'toutes les versions de Windows, Mac Os version 10.4 ou version ultérieure, Linux Kernel 2.6 ou version ultérieure',
            'produit_id' => '1',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);
       
        DB::table('regles')->insert([ 
            'id' => '18',
            'titre' => 'Protocole USB',
            'contenu' => 'USB 2.0',
            'produit_id' => '1',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('regles')->insert([ 
            'id' => '19',
            'titre' => 'Connectivité',
            'contenu' => '1x haute vitesse, 4pin USB,type A',
            'produit_id' => '1',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('regles')->insert([ 
            'id' => '20',
            'titre' => 'Branchement',
            'contenu' => 'plug and play',
            'produit_id' => '1',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('regles')->insert([ 
            'id' => '21',
            'titre' => 'Températeure',
            'contenu' => 'Min : 0° , Max : 60°',
            'produit_id' => '1',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('regles')->insert([ 
            'id' => '22',
            'titre' => 'Dimensions',
            'contenu' => '67mm x 117mm x 35mm',
            'produit_id' => '1',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('regles')->insert([ 
            'id' => '23',
            'titre' => 'Poids',
            'contenu' => '85 grs',
            'produit_id' => '1',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('regles')->insert([ 
            'id' => '24',
            'titre' => 'Compatibilité',
            'contenu' => 'toutes les versions de Windows, Mac Os version 10.4 ou version ultérieure, Linux Kernel 2.6 ou version ultérieure',
            'produit_id' => '2',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('regles')->insert([ 
            'id' => '25',
            'titre' => 'Protocole USB',
            'contenu' => 'USB 3.0',
            'produit_id' => '2',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('regles')->insert([ 
            'id' => '26',
            'titre' => 'Branchement',
            'contenu' => 'plug and play',
            'produit_id' => '2',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('regles')->insert([ 
            'id' => '27',
            'titre' => 'Températeure',
            'contenu' => 'Min : 0° , Max : 60°',
            'produit_id' => '2',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('regles')->insert([ 
            'id' => '28',
            'titre' => 'Tension',
            'contenu' => '250 V , Courant 10 A',
            'produit_id' => '6',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('regles')->insert([ 
            'id' => '29',
            'titre' => 'Compatibilité',
            'contenu' => 'Cable alimentation Eur Plug adapté aux moniteurs,ordinateurs,téleviseurs,imprimantes, scanners et projecteurs, code machine , brouilloire, cuiseur à riz',
            'produit_id' => '6',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('regles')->insert([ 
            'id' => '30',
            'titre' => 'Résistance de températeure',
            'contenu' => 'Max : 65°',
            'produit_id' => '6',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('regles')->insert([ 
            'id' => '31',
            'titre' => 'Puissance nominale',
            'contenu' => '2000 Watt',
            'produit_id' => '6',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('regles')->insert([ 
            'id' => '32',
            'titre' => 'Matériaux',
            'contenu' => 'Ignifuge en PVC, noyeau de cuivre de haute qualité',
            'produit_id' => '6',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);
         
        DB::table('regles')->insert([ 
            'id' => '33',
            'titre' => 'Longueur du cable',
            'contenu' => '1,2 métres',
            'produit_id' => '6',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('regles')->insert([ 
            'id' => '34',
            'titre' => 'Poids',
            'contenu' => '115 grs',
            'produit_id' => '6',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);
        
        DB::table('regles')->insert([ 
            'id' => '35',
            'titre' => 'Type de charge',
            'contenu' => 'Universel',
            'produit_id' => '5',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

        DB::table('regles')->insert([ 
            'id' => '36',
            'titre' => 'Entrées',
            'contenu' => 'Entrée A : USB, Entrée B : Micro USB ',
            'produit_id' => '5',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);


        DB::table('regles')->insert([ 
            'id' => '37',
            'titre' => 'Transfert de données mobiles',
            'contenu' => 'Oui',
            'produit_id' => '5',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);


        DB::table('regles')->insert([ 
            'id' => '38',
            'titre' => 'Longueur du câble',
            'contenu' => '1 mètre',
            'produit_id' => '5',
            'user_id' => '5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')      
        ]);

    }
}
