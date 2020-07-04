
@extends('main.index')

@section('content')
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row main-header">
                <div class="col-lg-8 p-0">
                    <div class="page-header">
                        <div class="page-title"><h3>Statistiques retours articles  ( année : {{ $yearDisplayed }})</h3></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{ route('home')}}"> Accueil</a></li>
                                <li class="active"><a href="{{route('statistiques.retour',$yearDisplayed) }}"> Retours</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="col pull-right m-b-10 m-r-40">
                    <div class="row">
                        <a role="button" class="btn btn-default" href="{{ route('statistiques.article',$yearDisplayed)}}">
                            Filtrer par article
                        </a>
                        <div class="dropdown" style="display: inline-block;">
                            <button id="menu1" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"> Filtrer par année
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="menu1" role="menu" style="height:500%; overflow:hidden; overflow-y:scroll;">
                                @for($year = Carbon\Carbon::now('y')->subYears(10)->year; $year < Carbon\Carbon::now('y')->addYears(20)->year; $year++)
                                <li role="presentation"><a role="menuitem" href="{{ route('statistiques.retour',$year)}}">
                                    {{ $year }}
                                </a></li>
                                @endfor
                            </ul>
                        </div>
                        <div class="dropdown" style="display: inline-block">

                            <button id="menu2" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"> Filtrer par type
                                <span class="caret"></span></button>
                            <ul class="dropdown-menu" aria-labelledby="menu2" role="menu">
                                
                                <li role="presentation"><a role="menuitem" href=" {{ route('statistiques.retourClient', $yearDisplayed) }}">Retour client</a></li> 
                                <li role="presentation"><a role="menuitem" href=" {{ route('statistiques.retourProduction', $yearDisplayed) }} ">Retour production</a></li>
                                <li role="presentation"><a role="menuitem" href=" {{ route('statistiques.retourFournisseur', $yearDisplayed) }}">Retour fournisseur</a></li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-content">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card alert">
                            <div class="card-header">
                                <h4>Evolution des retours articles </h4>
                                <div class="card-header pull-right">
                                </div>
                            </div>                  
                            <div class="retours-chart card-content">
                                {!! $lineChart->container() !!}
                                {!! $lineChart->script() !!}
                            </div>
                        </div>
                    </div>                        
                    <div class="col-lg-4">
                        <div class="card alert">
                            <div class="card-header">
                                <h4>Répartition des retours articles </h4>
                            </div>
                            <div class="camembert card-content">
                                {!! $camembertChart->container() !!}
                                {!! $camembertChart->script() !!}
                            </div>   
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card alert">
                            <div class="card-header m-b-10">
                                <h4>Récapitulatif des retours par Type</h4>
                            </div>
                            <div class="card-body card-content stats">
                                <table class="table table-responsive table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="col-md-1 text-center" scope="col">Source\Mois</th>
                                            @foreach (Helper::getMonths() as $month)
                                                <th class="col-md-1 text-center" scope="col">
                                                    {{ $month }}</th>
                                            @endforeach
                                                <th class="col-md-1 text-center" scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($total = 0)                                      
                                        @php($totalParMois = array())                                      
                                        @foreach(Helper::getTypesRetour() as $type)
                                        <tr class="text-center">
                                            <th class="col-md-1 text-center" scope="col">{{ $type }}</th>
                                            @php($totalParType = 0)                                      
                                            @foreach(Helper::getMonthsAbv() as $mois)
                                                <?php
                                                    $monthNum = sprintf("%02s",array_search($mois,Helper::getMonthsAbv())+1);
                                                    $retourParMoisType = App\Models\Statistique::retourParMoisType($monthNum,$yearDisplayed,$type);
                                                    if(!isset($totalParMois[(int)$monthNum])) $totalParMois[(int)$monthNum] = 0;
                                                    $totalParMois[(int)$monthNum] += (int)$retourParMoisType;
                                                    $totalParType += $retourParMoisType;
                                                    $total+=$retourParMoisType;
                                                ?>
                                                <td>{{ $retourParMoisType}}</td>
                                            @endforeach
                                            <td>{{ $totalParType }}</td>      
                                        </tr>
                                        @endforeach
                                        <tr class="text-center">
                                            <th class="col-md-1 text-center" scope="col">
                                                Total</th>
                                            @for ($i = 1; $i < count($totalParMois)+1; $i++)
                                                <td>{{ $totalParMois[$i]}}</td>
                                            @endfor
                                            <td>{{ $total }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 @endsection