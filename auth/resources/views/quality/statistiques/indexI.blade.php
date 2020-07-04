
@extends('main.index')

@section('content')
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row main-header">
                <div class="col-lg-8 p-0">
                    <div class="page-header">
                        <div class="page-title"><h1>Statistiques inspections des articles</h1></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{ route('home')}}">Accueil</a></li>
                                <li class="active"><a href="{{ route('home')}}">Statistiques Inspections</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="col pull-right m-b-10 m-r-40">
                    <div class="row">
                        <div class="dropdown" style="display: inline-block;">
                            <button id="menu1" class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown"> Filtrer par année
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="menu1" role="menu" style="height:500%; overflow:hidden; overflow-y:scroll;">
                                @for($year = Carbon\Carbon::now('y')->subYears(10)->year; $year < Carbon\Carbon::now('y')->addYears(20)->year; $year++)
                                <li role="presentation"><a role="menuitem" href="{{ route('statistiques.inspection',$year)}}">
                                    {{ $year }}
                                </a></li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-content">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card alert">
                            <div class="card-header m-b-10">
                                <h4>Histogramme des inspections par type ( année : {{ $yearDisplayed }})</h4>
                                <div class="card-header pull-right">
                                </div>
                            </div>
                            <div class="retours-chart card-content">
                                {!! $histoChart->container() !!}
                                {!! $histoChart->script() !!}                            
                            </div>
                        </div>
                    </div>                        
                    <div class="col-lg-4">
                        <div class="card alert">
                            <div class="card-header">
                                <h4>Répartition par type d'inspection</h4>
                            </div>
                            <div class="camembert card-content">
                                {!! $pieChart->container() !!}
                                {!! $pieChart->script() !!}         
                            </div>   
                        </div>
                    </div> 
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card alert">
                            <div class="card-header m-b-10">
                                <h4>Récapitulatif des inspection ( année : {{ $yearDisplayed }})</h4>
                            </div>
                            <div class="card-body card-content stats">
                                <table class="table table-responsive table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="col-md-1 text-center" scope="col">Type\Mois</th>
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
                                        @foreach(Helper::getTypeInspection() as $type)
                                        <tr class="text-center">
                                            <th class="col-md-1 text-center" scope="col">{{ $type }}</th>
                                            @php($totalParType = 0)                                      
                                            @foreach(Helper::getMonthsAbv() as $mois)
                                                <?php
                                                    $monthNum = sprintf("%02s",array_search($mois,Helper::getMonthsAbv())+1);
                                                    $retourParMoisType = App\Models\Statistique::InspectionParMoisResultat($monthNum,$yearDisplayed,array_search($type,Helper::getTypeInspection()));
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