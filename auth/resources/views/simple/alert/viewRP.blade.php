@extends('main.index')
@section('content')
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row main-header">
                <div class="col-lg-8 p-0">
                    <div class="page-header">
                        <div class="page-title">
                            <h1>Gestion des alertes</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 p-0">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{ route('home')}}">Accueil</a></li>
                                <li><a href="{{ route('alertRP.list')}}">Alertes retour production</a></li>
                                <li class="active">  
                                  
                                    {{ __('Consulter') }}
                                 
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-content">
                <div class="col-lg-12 p-r-0 p-l-0">
                    <div class="card alert">
                        <div class="card-header">
                            <div class="col-lg-6">
                                <h4> {{ __('Consultation alerte retour production') }} </h4>
                            </div>

                            <div class="col-lg-6">
                                <div class="text-right"> 
                                        @if(isset($alert))
                                        <a target="_blank" href="{{ route('alertRP.pdf',$alert)}}">
                                            <button type="button" class="btn btn-info btn-addon m-b-10 m-l-5">
                                                <i class="ti-share"></i>Télecharger la fiche
                                                </button>                 
                                        </a>  
                                        @endif      
                                </div>        
                            </div>
                        </div>
                        <br><br>
                        <br><br>
                        <div class="card-body">
                            <div class="basic-form">
                                <form method="POST"> 
                                    {{ csrf_field()}}
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="produit" class="text-right p-t-10 col-md-4">{{ __('Article') }}</label>
                                            <div class="col-md-5">
                                                <input readonly="readonly" type="text" class="form-control" name="quantite"
                                                            @if(isset($alert))
                                                            value="{{ $alert->lot->produit->nom  }}" 
                                                            @endif 
                                                            required>                                         
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="caracteristique" class="text-right p-t-10 col-md-4">{{ __('Caractéristique') }}</label>
                                            <div class="col-md-5">
                                                <input  readonly="readonly" type="text" class="form-control" name="quantite"
                                                            @if(isset($alert))
                                                            value="{{ $alert->lot->caracteristiquep }}" 
                                                            @endif 
                                                            required>                                    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="quantite" class="text-right p-t-10 col-md-4">{{ __('Quantité') }}</label>
                                            <div class="col-md-5">
                                                <input  readonly="readonly" type="text" class="form-control" name="quantite"
                                                @if(isset($alert))
                                                value="{{ $alert->lot->quantite }}" 
                                                @endif 
                                                required>                                    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="atelier" class="text-right p-t-10 col-md-4">{{ __('Atelier') }}</label>
                                            <div class="col-md-5">
                                                <input readonly="readonly" type="text" class="form-control" name="quantite"
                                                            @if(isset($alert))
                                                            value="{{ $alert->atelier->nom }}" 
                                                            @endif 
                                                            required>                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="motif" class="text-right p-t-10 col-md-4">{{ __('Motif de retour') }}</label>
                                            <div class="col-md-5">
                                                <input  readonly="readonly" type="text" class="form-control" name="motif"
                                                @if(isset($alert))
                                                value="{{ $alert->motif }}" 
                                                @endif>                                    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="description" class="text-right p-t-10 col-md-4">{{ __('Description') }}</label>
                                            <div class="col-md-5">
                                                <textarea  readonly="readonly" name="description" class="form-control" rows="3">@if(isset($alert)){{ $alert->description }}@endif</textarea>                                   
                                            </div>
                                        </div>
                                    </div><br><br>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>          
    </div>    
</div> 
@endsection

