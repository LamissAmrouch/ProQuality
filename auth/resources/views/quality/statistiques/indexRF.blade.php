
@extends('main.index')

@section('content')
<div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row main-header">
                    <div class="col-lg-8 p-0">
                        <div class="page-header">
                            <div class="page-title"><h3>Statistiques retours fournisseur ( année : {{ $yearDisplayed }} )</h3></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="{{ route('home')}}">Accueil</a></li>
                                    <li><a href="{{ route('statistiques.retour',$yearDisplayed)}}">Retours</a></li>
                                    <li class="active"><a href="{{ route('statistiques.retourFournisseur' , $yearDisplayed) }}">Retours par Type</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="col pull-right m-b-10 m-r-40">
                        <div class="row">
                            <div class="dropdown" style="display: inline-block;">
                                    <button id="menu1" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"> Filtrer par année
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="menu1" role="menu" style="height:500%; overflow:hidden; overflow-y:scroll;">
                                        @for($year = Carbon\Carbon::now('y')->subYears(10)->year; $year < Carbon\Carbon::now('y')->addYears(20)->year; $year++)
                                        <li role="presentation"><a role="menuitem" href="{{ route('statistiques.retourFournisseur',$year)}}">
                                            {{ $year }}
                                        </a></li>
                                        @endfor
                                    </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <div class="main-content">
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card alert">
                                <div class="card-header m-b-10">
                                    <h4>Quantité de retour fournisseur par marchandise </h4>
                                </div>
                                <div class="card-body card-content">

                                        <div style="width: 90%;margin: 0 auto;">
                                        {!! $chart->container() !!}
                                        </div>
                            
                                            {!! $chart->script() !!}
                                </div>
                            </div>
                        </div>
                    
                        
                        <div class="col-lg-6">
                            <div class="card alert">
                                <div class="card-header m-b-10">
                                    <h4>Quantité de retour fournisseur par fournisseur </h4>
                                </div>
                                <div class="card-body card-content">

                                        <div style="width: 90%;margin: 0 auto;">
                                        {!! $chartF->container() !!}
                                        </div>
                            
                                            {!! $chartF->script() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                        
                </div>


 @endsection