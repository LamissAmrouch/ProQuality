
@extends('main.index')

@section('content')
<div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row main-header">
                    <div class="col-lg-8 p-0">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Accueil</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="page-header breadcrum">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li class="active"><a href="{{ route('home')}}">Accueil</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-content">
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="card">
                                <div class="stat-widget-one">
									<div class="stat-icon dib"><i class="ti-bell color-secondary"></i></div>
									<div class="stat-content dib">
										<div class="stat-text">Alertes</div>
                                        <div class="stat-digit">{{ sprintf("%02s",App\Models\Statistique::alerteNonTraite())}}</div>
									</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card">
                                <div class="stat-widget-one">
									<div class="stat-icon dib"><i class="ti-alert color-danger"></i></div>
									<div class="stat-content dib">
										<div class="stat-text">Anomalies</div>
										<div class="stat-digit">{{ sprintf("%02s",App\Models\Statistique::anomalieEnCours())}}</div>
									</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card">
                                <div class="stat-widget-one">
									<div class="stat-icon dib"><i class="ti-write color-info"></i></div>
									<div class="stat-content dib">
										<div class="stat-text">Inspections</div>
										<div class="stat-digit">{{ sprintf("%02s",App\Models\Statistique::inspectionEnAttente())}}</div>
									</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card">
                                <div class="stat-widget-one">
									<div class="stat-icon dib"><i class="ti-clipboard color-primary"></i></div>
									<div class="stat-content dib">
										<div class="stat-text">Audits</div>
										<div class="stat-digit">{{ sprintf("%02s",App\Models\Statistique::auditPlanifie())}}</div>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card alert">
                                <div class="card-header">
                                    <h4>Programmées récemments</h4>
                                </div>
                                <div class="card-body card-content">
                                    <table class="table table-responsive table-hover">
                                        <thead>
                                            <tr>
                                                <th>Titre</th>
                                                <th>Type</th>
                                                <th>Date</th>
                                                <th>Etat</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (App\Models\Statistique::auditsRécents() as $audit)
                                            <tr>
                                                <td>{{$audit->titre}}</td>
                                                <td><span class="badge badge-primary">Audit</span></td>
                                                <td>{{$audit->updated_at->format('Y-m-d')}}</td>
                                                <td>{{$audit->etat}}</td>
                                                <td></td>
                                            </tr>
                                            @endforeach
                                            @foreach (App\Models\Statistique::inspectionsRécentes() as $inspection)
                                            <tr>
                                                <td>{{$inspection->titre}}</td>
                                                <td><span class="badge badge-info">Inspection</span></td>
                                                <td>{{$inspection->updated_at->format('Y-m-d')}}</td>
                                                <td>{{$inspection->etat}}</td>
                                                <td></td>
                                            </tr>
                                            @endforeach
                                            @foreach (App\Models\Statistique::retoursRécents() as $alerte)
                                            <tr>
                                                <td>{{$alerte->type}}</td>
                                                <td><span class="badge badge-danger">Anomalie</span></td>
                                                <td>{{$alerte->updated_at->format('Y-m-d')}}</td>
                                                <td>{{$alerte->etat}}</td>
                                                <td></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /# column -->
                    </div>
                </div>
                 <!-- /# container-fluid -->
 @endsection