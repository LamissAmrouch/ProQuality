<?php

namespace App\Http\Controllers\Gestionnaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Alert;
use App\Models\Produit;
use App\Models\Statistique;
use App\Charts\TestChart;
use App\Helpers\Helper;
use App\Models\Client;
use App\Models\Fournisseur;
use App\Models\Atelier;
use DB;


class StatistiquesController extends Controller{

    public function indexRetour($year){
        $lineChart = new TestChart;
        $camembertChart = new TestChart;
        $i = 0;
        $totalRetour = array();
        $color = array();
        $color[0] = '#00ED96';
        $color[1]= '#F1BE25';
        $color[2]= '#444BF8';
        $backgroundColor = array();
        $backgroundColor[0] ="rgba(0, 237, 150,0.7)";
        $backgroundColor[1] ="rgba(241, 190, 37,0.8)";
        $backgroundColor[2] ="rgba(68, 75, 248,0.8)";
        
        $lineChart->labels(Helper::getMonthsAbv());
        $lineChart->options([
            'legend'=> [
                'labels' => [
                    'usePointStyle' => true,
                    'fontFamily' => 'Poppins',
                    'fontColor' => 'black'
                ],
            ],
            'tooltips' => [
                'enabled' => true,
                'mode'=> 'index',
                'titleFontSize'=> 12,
                'titleFontColor'=> '#000',
                'bodyFontColor'=> '#000',
                'backgroundColor'=> '#fff',
                'titleFontFamily'=> 'Poppins',
                'bodyFontFamily'=> 'Poppins',
                'cornerRadius'=> 3,
                'intersect'=> false,
            ],
            'scales' => [
                'xAxes'  => [[
                    'display' => true,
                    'gridLines' => [
                        'display' => false,
                        'drawBorder' => true
                    ],
                    'scaleLabel' => [
                        'fontColor' => 'black',
                        'display' => true,
                        'labelString' => 'Mois',
                        'fontSize' => 18,
                    ]
                ]],
                'yAxes'  => [[
                    'display' => true,
                    'gridLines' => [
                        'display' => false,
                        'drawBorder' => true
                    ],
                    'scaleLabel' => [
                        'fontColor' => 'black',
                        'display' => true,
                        'fontSize' => 18,
                        'labelString' => "Quantité d'articles"
                    ]
                ]],
            ]
        ]);
        foreach (Helper::getTypesRetour() as $type) {
            $lineChart->dataset($type , 'line',  Statistique::retourParMois($type,$year))->options([
                'fill' => 'true',
                'borderColor' => '#00ed96',
                'backgroundColor' => 'transparent',
                'borderColor' => $color[$i],
                'borderWidth' => 3,
                'pointStyle' => 'circle',
                'pointRadius' => 5,
                'pointBorderColor' => 'transparent',
                'pointBackgroundColor' => $color[$i],
            ]);
            $totalRetour[$i] = Statistique::retourTotalParType($type,$year);
            $i++;
        }

        $camembertChart->labels(Helper::getTypesRetour());
        $camembertChart->dataset('Retours' , 'pie',  $totalRetour)->options([
            'fill' => 'true',
            'fontColor' => 'black',
            'backgroundColor' => $color,
            'hoverBackgroundColor' => $backgroundColor,
        ]);
        $camembertChart->options([
            'scales' => [
                'xAxes'  => [[
                    'display' => false,
                ]],
                'yAxes'  => [[
                    'display' => false,
                ]],
            ]
        ]);
        $yearDisplayed = $year;
        return view('quality.statistiques.indexR',compact('lineChart','camembertChart','yearDisplayed'));
    }

    public function indexArticle($year){

        $barChart = new TestChart;
        $camembertChart = new TestChart;
        $i = 0;
        $total = array();
        $color = array();
        $color[0] = '#00ED96';
        $color[1]= '#F1BE25';
        $color[2]= '#444BF8';
        $backgroundColor = array();
        $backgroundColor[0] ="rgba(0, 237, 150,0.7)";
        $backgroundColor[1] ="rgba(241, 190, 37,0.8)";
        $backgroundColor[2] ="rgba(68, 75, 248,0.8)";

        $articles = Produit::all();
        $barChart->labels($articles->pluck('nom'));
        $barChart->options([
            'legend'=> [
                'display' => false,
            ],
            'tooltips' => [
                'enabled' => true,
                'mode'=> 'index',
                'titleFontSize'=> 12,
                'titleFontColor'=> '#000',
                'bodyFontColor'=> '#000',
                'backgroundColor'=> '#fff',
                'titleFontFamily'=> 'Poppins',
                'bodyFontFamily'=> 'Poppins',
                'cornerRadius'=> 3,
                'intersect'=> false,
            ],
            'scales' => [
                'xAxes'  => [[
                    'display' => true,
                    'gridLines' => [
                        'display' => false,
                        'drawBorder' => true
                    ],
                    'scaleLabel' => [
                        'fontColor' => 'black',
                        'display' => true,
                        'fontSize' => 18,
                        'labelString' => 'Articles'
                    ]
                ]],
                'yAxes'  => [[
                    'display' => true,
                    'gridLines' => [
                        'display' => false,
                        'drawBorder' => true
                    ],
                    'scaleLabel' => [
                        'fontColor' => 'black',
                        'display' => true,
                        'fontSize' => 18,
                        'labelString' => "Nombre"
                    ]
                ]],
            ]
        ]);
        $barChart->dataset('Retour par Article' , 'bar', Statistique::retourParArticle($articles,$year))->options([
            'fill' => 'true',
            'backgroundColor' => '#00ED96',
            'borderColor' => '#00ED96',
            'borderWidth' => 3,
        ]);

        $typeArticles = Helper::getTypesArticle();
        $camembertChart->labels($typeArticles);
        $camembertChart->dataset("Retour par Type d'Article" , 'doughnut', Statistique::retourParTypeArticle($typeArticles,$year))->options([
            'fill' => 'true',
            'fontColor' => 'black',
            'backgroundColor' => $color,
            'hoverBackgroundColor' => $backgroundColor,
        ]);
        $camembertChart->options([
            'scales' => [
                'xAxes'  => [[
                    'display' => false,
                ]],
                'yAxes'  => [[
                    'display' => false,
                ]],
            ]
        ]); 
        $yearDisplayed = $year;
        return view('quality.statistiques.indexArticle',compact('camembertChart','barChart','yearDisplayed'));

    }
            
    public function indexRetourClient($year)
    { 
        // retour client par produit ou article
        $produits =  Produit::where('type', '=' ,'Fini')->get();
        $nomsProduit =  Produit::where('type', '=' ,'Fini')->pluck('nom');
        $nombreretourClient = array();
        $i = 0;
        
        foreach($produits as $produit)
        {   
            $nombreretourClientParProduit[$i] = Statistique::retourParArticleType($produit->nom,'Retour client',$year);
            $i++ ;
        }

        $chart = new TestChart;
        $chart->labels(   $nomsProduit->values() );
        //$chart->title('Quantité de retour client par article');
        $chart->options([
            'legend'=> [
                'display' => false,
            ],
            'tooltips' => [
                'enabled' => true,
                'mode'=> 'index',
                'titleFontSize'=> 12,
                'titleFontColor'=> '#000',
                'bodyFontColor'=> '#000',
                'backgroundColor'=> '#fff',
                'titleFontFamily'=> 'Poppins',
                'bodyFontFamily'=> 'Poppins',
                'cornerRadius'=> 3,
                'intersect'=> false,
            ],
            'scales' => [
                'xAxes'  => [[
                    'display' => true,
                    'gridLines' => [
                        'display' => false,
                        'drawBorder' => true
                    ],
                    'scaleLabel' => [
                        'fontColor' => 'black',
                        'display' => true,
                        'labelString' => 'Articles',
                        'fontSize' => 18,
                    ]
                ]],
                'yAxes'  => [[
                    'display' => true,
                    'gridLines' => [
                        'display' => false,
                        'drawBorder' => true
                    ],
                    'scaleLabel' => [
                        'fontColor' => 'black',
                        'display' => true,
                        'labelString' => "Quantité",
                        'fontSize' => 18,
                    ]
                ]],
            ]
        ]);
        $chart->dataset('Quantité de retour client', 'bar', $nombreretourClientParProduit)->options([
            'fill' => 'true',
            'borderColor' => '#444BF8',
            'backgroundColor' => '#444BF8',   
        ]);;  
      
        // retour client par client
        $clients = Client::all();
        $array = array();

        foreach($clients as $client)
        {   
            //$nombreretourClient[$i] = Statistique::retourParClient($client->id);
            $array = array_add($array, $client->nom , Statistique::retourParClient($client->id,$year) );
        }
 
        array_multisort($array,SORT_DESC);  // sort the array 
        $array2 = array_slice($array, 0, 10, true); // get the first 10 elements only 
        list($keys, $values) = array_divide($array2); // separate the keys and the values in two arrays
        //$nomsClients = Client::all()->pluck('nom');
       
        $chartClient = new TestChart;
        $chartClient->labels( $keys );
        $chartClient->options([
            'legend'=> [
                'display' => false,
            ],
            'tooltips' => [
                'enabled' => true,
                'mode'=> 'index',
                'titleFontSize'=> 12,
                'titleFontColor'=> '#000',
                'bodyFontColor'=> '#000',
                'backgroundColor'=> '#fff',
                'titleFontFamily'=> 'Poppins',
                'bodyFontFamily'=> 'Poppins',
                'cornerRadius'=> 3,
                'intersect'=> false,
            ],
            'scales' => [
                'xAxes'  => [[
                    'display' => true,
                    'gridLines' => [
                        'display' => false,
                        'drawBorder' => true
                    ],
                    'scaleLabel' => [
                        'fontColor' => 'black',
                        'display' => true,
                        'labelString' => 'Clients',
                        'fontSize' => 18,
                    ]
                ]],
                'yAxes'  => [[
                    'display' => true,
                    'gridLines' => [
                        'display' => false,
                        'drawBorder' => true
                    ],
                    'scaleLabel' => [
                        'fontColor' => 'black',
                        'display' => true,
                        'labelString' => "Quantité",
                        'fontSize' => 18,
                    ]
                ]],
            ]
        ]);

        $chartClient->dataset('Quantité de retour client', 'bar', $values)->options([
            'fill' => 'true',
            'borderColor' => '#444BF8',
            'backgroundColor' => '#444BF8',   
        ]);; 
        $yearDisplayed = $year;
        return view('quality.statistiques.indexRC',compact('chart','chartClient','yearDisplayed'));
    }

    public function indexRetourProduction($year)
    {   
                
        // Histogramme 1 : retour production par produit ou article
        $produits =  Produit::where('type', '=' ,'Fini')->get();
        $nomsProduit =  Produit::where('type', '=' ,'Fini')->pluck('nom');
        $i = 0;
        
        foreach($produits as $produit)
        {   
            $nombreretourProductionParProduit[$i] = Statistique::retourParArticleType($produit->nom,'Retour production',$year);
            $i++ ;
        }

        $chart = new TestChart;
        $chart->labels(   $nomsProduit->values() );
        $chart->options([
            'legend'=> [
                'display' => false,
            ],
            'tooltips' => [
                'enabled' => true,
                'mode'=> 'index',
                'titleFontSize'=> 12,
                'titleFontColor'=> '#000',
                'bodyFontColor'=> '#000',
                'backgroundColor'=> '#fff',
                'titleFontFamily'=> 'Poppins',
                'bodyFontFamily'=> 'Poppins',
                'cornerRadius'=> 3,
                'intersect'=> false,
            ],
            'scales' => [
                'xAxes'  => [[
                    'display' => true,
                    'gridLines' => [
                        'display' => false,
                        'drawBorder' => true
                    ],
                    'scaleLabel' => [
                        'fontColor' => 'black',
                        'display' => true,
                        'labelString' => 'Article',
                        'fontSize' => 18,
                    ]
                ]],
                'yAxes'  => [[
                    'display' => true,
                    'gridLines' => [
                        'display' => false,
                        'drawBorder' => true
                    ],
                    'scaleLabel' => [
                        'fontColor' => 'black',
                        'display' => true,
                        'labelString' => "Quantité",
                        'fontSize' => 18,
                    ]
                ]],
            ]
        ]);

        $chart->dataset('Quantité de retour production', 'bar', $nombreretourProductionParProduit)->options([
            'fill' => 'true',
            'borderColor' => '#F1BE25',
            'backgroundColor' => '#F1BE25',   
        ]);;  

        //Histogramme 2 : retour production par atelier
        $ateliers = Atelier::all();
        $nomAteliers = Atelier::all()->pluck('nom');
        $i = 0;

        foreach($ateliers as $atelier)
        {   
            $nombreretourProductionParAtelier[$i] = Statistique::retourParAtelier($atelier->id,$year);
            $i++;
        }

        $chartP = new TestChart;
        $chartP->labels( $nomAteliers->values() );
        $chartP->options([
            'legend'=> [
                'display' => false,
            ],
            'tooltips' => [
                'enabled' => true,
                'mode'=> 'index',
                'titleFontSize'=> 12,
                'titleFontColor'=> '#000',
                'bodyFontColor'=> '#000',
                'backgroundColor'=> '#fff',
                'titleFontFamily'=> 'Poppins',
                'bodyFontFamily'=> 'Poppins',
                'cornerRadius'=> 3,
                'intersect'=> false,
            ],
            'scales' => [
                'xAxes'  => [[
                    'display' => true,
                    'gridLines' => [
                        'display' => false,
                        'drawBorder' => true
                    ],
                    'scaleLabel' => [
                        'fontColor' => 'black',
                        'display' => true,
                        'labelString' => 'Ateliers',
                        'fontSize' => 18,
                    ]
                ]],
                'yAxes'  => [[
                    'display' => true,
                    'gridLines' => [
                        'display' => false,
                        'drawBorder' => true
                    ],
                    'scaleLabel' => [
                        'fontColor' => 'black',
                        'display' => true,
                        'labelString' => "Quantité",
                        'fontSize' => 18,
                    ]
                ]],
            ]
        ]);


        $chartP->dataset('Quantité de retour production', 'bar', $nombreretourProductionParAtelier)->options([
            'fill' => 'true',
            'borderColor' => '#F1BE25',
            'backgroundColor' => '#F1BE25',   
        ]);; 
      
        $yearDisplayed = $year;
        return view('quality.statistiques.indexRP',compact('chart','chartP','yearDisplayed'));

    }


    public function indexRetourFournisseur($year)
    {   
                  
        // Histogramme 1 : retour fournisseur par matiere premiere
        $MPs =  Produit::where('type', '=' ,'Matiere premiere')->get();
        $array = array();

        foreach($MPs as $MP)
        {   
            $array = array_add($array, $MP->nom ,  Statistique::retourParArticleType($MP->nom,'Retour fournisseur',$year) );
        }
 
        array_multisort($array,SORT_DESC);  // sort the array 
        $array2 = array_slice($array, 0, 10, true); // get the first 10 elements only 
        list($keys, $values) = array_divide($array2); // separate the keys and the values in two arrays
      
        $chart = new TestChart;
        $chart->labels( $keys );
        $chart->options([
            'legend'=> [
                'display' => false,
            ],
            'tooltips' => [
                'enabled' => true,
                'mode'=> 'index',
                'titleFontSize'=> 12,
                'titleFontColor'=> '#000',
                'bodyFontColor'=> '#000',
                'backgroundColor'=> '#fff',
                'titleFontFamily'=> 'Poppins',
                'bodyFontFamily'=> 'Poppins',
                'cornerRadius'=> 3,
                'intersect'=> false,
            ],
            'scales' => [
                'xAxes'  => [[
                    'display' => true,
                    'gridLines' => [
                        'display' => false,
                        'drawBorder' => true
                    ],
                    'scaleLabel' => [
                        'fontColor' => 'black',
                        'display' => true,
                        'labelString' => 'Marchandise',
                        'fontSize' => 18,
                    ]
                ]],
                'yAxes'  => [[
                    'display' => true,
                    'gridLines' => [
                        'display' => false,
                        'drawBorder' => true
                    ],
                    'scaleLabel' => [
                        'fontColor' => 'black',
                        'display' => true,
                        'labelString' => "Quantité",
                        'fontSize' => 18,
                    ]
                ]],
            ]
        ]);


        $chart->dataset('Quantité de retour fournisseur', 'bar', $values)->options([
            'fill' => 'true',
            'borderColor' => '#00ed96',
            'backgroundColor' => '#00ed96',   
        ]);; 

        //Histogramme 2 : retour fournisseur par fournisseur
        $fournisseurs = Fournisseur::all();
        $array = array();

        foreach($fournisseurs as $fournisseur)
        {   
            $array = array_add($array, $fournisseur->nom , Statistique::retourParFournisseur($fournisseur->id,$year) );
        }
 
        array_multisort($array,SORT_DESC);  // sort the array 
        $array2 = array_slice($array, 0, 10, true); // get the first 10 elements only 
        list($keys, $values) = array_divide($array2); // separate the keys and the values in two arrays
       
       
        $chartF = new TestChart;
        $chartF->labels( $keys );
        $chartF->options([
            'legend'=> [
                'display' => false,
            ],
            'tooltips' => [
                'enabled' => true,
                'mode'=> 'index',
                'titleFontSize'=> 12,
                'titleFontColor'=> '#000',
                'bodyFontColor'=> '#000',
                'backgroundColor'=> '#fff',
                'titleFontFamily'=> 'Poppins',
                'bodyFontFamily'=> 'Poppins',
                'cornerRadius'=> 3,
                'intersect'=> false,
            ],
            'scales' => [
                'xAxes'  => [[
                    'display' => true,
                    'gridLines' => [
                        'display' => false,
                        'drawBorder' => true
                    ],
                    'scaleLabel' => [
                        'fontColor' => 'black',
                        'display' => true,
                        'labelString' => 'Fournisseurs',
                        'fontSize' => 18,
                    ]
                ]],
                'yAxes'  => [[
                    'display' => true,
                    'gridLines' => [
                        'display' => false,
                        'drawBorder' => true
                    ],
                    'scaleLabel' => [
                        'fontColor' => 'black',
                        'display' => true,
                        'labelString' => "Quantité",
                        'fontSize' => 18,
                    ]
                ]],
            ]
        ]);

        $chartF->dataset('Quantité de retour fournisseur', 'bar', $values)->options([
            'fill' => 'true',
            'borderColor' => '#00ed96',
            'backgroundColor' => '#00ed96',   
        ]);; 
      
        $yearDisplayed = $year;
        return view('quality.statistiques.indexRF',compact('chart','chartF','yearDisplayed'));

    }


    public function indexAudit($year){
        $barChart = new TestChart;
        $camembertChart = new TestChart;
        $i = 0;
        $total = array();
        $color = array();
        $color[0] = '#F12559';
        $color[1]= '#00ED96';
        $barChart->labels(Helper::getMonthsAbv());
        $barChart->options([
            'legend'=> [
                'labels' => [
                    'usePointStyle' => true,
                    'fontFamily' => 'Poppins',
                    'fontColor' => 'black'
                ],
            ],
            'tooltips' => [
                'enabled' => true,
                'mode'=> 'index',
                'titleFontSize'=> 12,
                'titleFontColor'=> '#000',
                'bodyFontColor'=> '#000',
                'backgroundColor'=> '#fff',
                'titleFontFamily'=> 'Poppins',
                'bodyFontFamily'=> 'Poppins',
                'cornerRadius'=> 3,
                'intersect'=> false,
            ],
            'scales' => [
                'xAxes'  => [[
                    'display' => true,
                    'gridLines' => [
                        'display' => false,
                        'drawBorder' => true
                    ],
                    'scaleLabel' => [
                        'fontColor' => 'black',
                        'display' => true,
                        'fontSize' => 18,
                        'labelString' => 'Mois'
                    ]
                ]],
                'yAxes'  => [[
                    'display' => true,
                    'gridLines' => [
                        'display' => false,
                        'drawBorder' => true
                    ],
                    'scaleLabel' => [
                        'fontColor' => 'black',
                        'display' => true,
                        'fontSize' => 18,
                        'labelString' => "Nombre"
                    ]
                ]],
            ]
        ]);
        foreach (Helper::getResultatAudit() as $resultat) {
            $barChart->dataset($resultat , 'bar',  Statistique::auditParMois($resultat,$year))->options([
                'fill' => 'true',
                'backgroundColor' => $color[$i],
                'borderColor' => $color[$i],
                'borderWidth' => 3,
            ]);
            $total[$i] = Statistique::auditTotalParResulat($resultat,$year);
            $i++;
        }
        $camembertChart->labels(Helper::getResultatAudit());
        $camembertChart->dataset('Audits' , 'pie',  $total)->options([
            'fill' => 'true',
            'fontColor' => 'black',
            'backgroundColor' => $color,
        ]);
        $camembertChart->options([
            'scales' => [
                'xAxes'  => [[
                    'display' => false,
                ]],
                'yAxes'  => [[
                    'display' => false,
                ]],
            ]
        ]);
        $yearDisplayed = $year;
        return view('quality.statistiques.indexA',compact('camembertChart','barChart','yearDisplayed'));

    }

    public function indexInspection($year){
        $histoChart = new TestChart;
        $pieChart = new TestChart;
        $i = 0;
        $total = array();
        $color = array();
        $color[0] = '#F12559';
        $color[1]= '#00ED96';
        $histoChart->labels(Helper::getMonthsAbv());
        $histoChart->options([
            'legend'=> [
                'labels' => [
                    'usePointStyle' => true,
                    'fontFamily' => 'Poppins',
                    'fontColor' => 'black'
                ],
            ],
            'tooltips' => [
                'enabled' => true,
                'mode'=> 'index',
                'titleFontSize'=> 12,
                'titleFontColor'=> '#000',
                'bodyFontColor'=> '#000',
                'backgroundColor'=> '#fff',
                'titleFontFamily'=> 'Poppins',
                'bodyFontFamily'=> 'Poppins',
                'cornerRadius'=> 3,
                'intersect'=> false,
            ],
            'scales' => [
                'xAxes'  => [[
                    'display' => true,
                    'gridLines' => [
                        'display' => false,
                        'drawBorder' => true
                    ],
                    'scaleLabel' => [
                        'fontColor' => 'black',
                        'display' => true,
                        'fontSize' => 18,
                        'labelString' => 'Mois'
                    ]
                ]],
                'yAxes'  => [[
                    'display' => true,
                    'gridLines' => [
                        'display' => false,
                        'drawBorder' => true
                    ],
                    'scaleLabel' => [
                        'fontColor' => 'black',
                        'display' => true,
                        'fontSize' => 18,
                        'labelString' => "Nombre"
                    ]
                ]],
            ]
        ]);
        foreach (Helper::getTypeInspection() as $resultat) {
            $histoChart->dataset($resultat , 'bar',  Statistique::inspectionParMois($resultat,$year))->options([
                'fill' => 'true',
                'backgroundColor' => $color[$i],
                'borderColor' => $color[$i],
                'borderWidth' => 3,
            ]);
            $total[$i] = Statistique::inspectionTotalParResulat($i,$year);
            $i++;
        }
        $pieChart->labels(Helper::getTypeInspection());
        $pieChart->dataset('Inspection' , 'pie',  $total)->options([
            'fill' => 'true',
            'fontColor' => 'black',
            'backgroundColor' => $color,
        ]);
        $pieChart->options([
            'scales' => [
                'xAxes'  => [[
                    'display' => false,
                ]],
                'yAxes'  => [[
                    'display' => false,
                ]],
            ]
        ]);
        $yearDisplayed = $year;
        return view('quality.statistiques.indexI',compact('histoChart','pieChart','yearDisplayed'));
    }
}

