@extends('main.index')

@section('content')
    <div class="content-wrap">
        <div class="main">
           <div class="container-fluid">
                <div class="row main-header">
                    <div class="col-lg-8 p-0">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Gestion des anomalies</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 p-0">
                        <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{ route('home')}}">Accueil</a></li>                    
                                <li><a href="{{ route('anomalie.dashbord')}}">anomalies</a></li>
                                <li class="active">                        
                                    
                                        {{ __('Consulter') }}
                                   
                                </li>                           
                            </ol>
                        </div>
                     </div>
                 </div>
             </div>
            <div class="main-content">
                <div class="card alert">
                        <div class="card-header">
                            <div class="col-lg-6">
                            <h4> {{ __('Consultation anomalie') }} </h4>
                            </div>

                            <div class="col-lg-6">
                                        <div class="text-right"> 
                                         @if(isset($anomalie))
                                                <a target="_blank" href="{{ route('anomalie.pdf',$anomalie)}}">
                                                    <button type="button" class="btn btn-info btn-addon m-b-10 m-l-5">
                                                        <i class="ti-share"></i>Télecharger la fiche</button>                 
                                                </a> 
                                         @endif  
                                        </div>        
                            </div>
                        </div>
                        <br><br>
                        <br><br>
                        <div class="card-body">                            
                                            
                                                    <div class="form-group">
                                                    <div class="row">
                                                        <label for="titre" class="text-right p-t-10 col-md-4">{{ __('Titre') }}</label>
                                                        <div class="col-md-5">
                                                        <input readonly="readonly"  id="titre" type="text" class="form-control" name="titre" 
                                                                    @if(isset($anomalie->titre))
                                                                        value="{{ $anomalie->titre }}" 
                                                                    @endif
                                                                    required autocomplete="titre" autofocus>
                                                    </div>
                                                    </div>
                                                    </div>

                                                    <div class="form-group">
                                                    <div class="row">
                                                        <label for="description" class="text-right p-t-10 col-md-4">{{ __('Description') }}</label>
                                                        <div class="col-md-5">
                                                        <textarea readonly="readonly" name="description" class="form-control" rows="3" required autofocus>@if(isset($anomalie->description)){{ $anomalie->description }}@endif</textarea>
                                                        </div>
                                                    </div>
                                                    </div>
 
                                                    <div class="form-group">
                                                    <div class="row">
                                                    <label class="text-right p-t-10 col-md-4">Type</label> 
                                                    <div class="col-md-5">            
                                                    <input readonly="readonly" id="procede" type="text" class="form-control" name="procede" 
                                                                    @if(isset($anomalie->type))
                                                                        value="{{ $anomalie->type }}" 
                                                                    @endif
                                                                    required autofocus> 
                                                    </div>
                                                    </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="text-right p-t-10 col-md-4">
                                                                @if($anomalie->type == 'Retour fournisseur')
                                                                    Fournisseur
                                                                @endif
                                                                @if($anomalie->type == 'Retour client')
                                                                    Client
                                                                @endif
                                                                @if($anomalie->type == 'Retour production')
                                                                    Atelier
                                                                @endif 
                                                            Source</label> 
                                                            <div class="col-md-5">            
                                                                <input readonly="readonly" type="text" class="form-control" 
                                                                @if($anomalie->type == 'Retour fournisseur')
                                                                    value="{{ $anomalie->fournisseur->nom }}"
                                                                @endif
                                                                @if($anomalie->type == 'Retour client')
                                                                    value="{{$anomalie->client->nom}}"
                                                                @endif
                                                                @if($anomalie->type == 'Retour production')
                                                                    value="{{$anomalie->atelier->nom}}"
                                                                @endif                                                                
                                                                >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="text-right p-t-10 col-md-4">Article</label> 
                                                            <div class="col-md-5">            
                                                                <input readonly="readonly" type="text" class="form-control"  
                                                                    @if(isset($anomalie->lot))
                                                                        value="{{ $anomalie->lot->produit->nom}} de type : {{ $anomalie->lot->caracteristiquep }}" 
                                                                    @endif
                                                                    required autofocus> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="text-right p-t-10 col-md-4">Quantité Défecteuse</label> 
                                                            <div class="col-md-5">            
                                                            <input readonly="readonly" type="text" class="form-control"  
                                                                            @if(isset($anomalie->lot))
                                                                                value="{{ $anomalie->lot->quantite}}" 
                                                                            @endif
                                                                            required autofocus> 
                                                            </div>
                                                        </div>
                                                    </div>    
                                                    <div class="form-group">
                                                    <div class="row">
                                                    <label class="text-right p-t-10 col-md-4">Test effectué</label> 
                                                    <div class="col-md-5">            
                                                    <input readonly="readonly" type="text" class="form-control"  
                                                                    @if(isset($anomalie->test))
                                                                        value="{{ $anomalie->test->nom}}" 
                                                                    @endif
                                                                    required autofocus> 
                                                    </div>
                                                    </div>
                                                    </div>

                                                    <div class="form-group">
                                                    <div class="row">
                                                    <label class="text-right p-t-10 col-md-4">Diagnostic</label> 
                                                    <div class="col-md-5">            
                                                    <input readonly="readonly" type="text" class="form-control"  
                                                                    @if(isset($anomalie->diagnostique))
                                                                        value="{{ $anomalie->diagnostique }}" 
                                                                    @endif
                                                                    required autofocus> 
                                                    </div>
                                                    </div>
                                                    </div>

                                

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label for="actions" class="text-right p-t-10 col-md-4">{{ __('Actions') }}</label>
                                                            <div class="col-md-5"> 
                                                                <select readonly="readonly" id="actions" class="form-control"  name="actions[]" multiple>
                                                                        @foreach(App\Models\Action::all() as $action)
                                                                            <option value="{{ $action->id }}"   
                                                                                @if( isset($anomalie->actions) && $anomalie->actions->contains($action))
                                                                                    selected
                                                                                @endif>
                                                                                {{ $action->designation }}
                                                                            </option>
                                                                        @endforeach
                                                                </select>                 
                                                            </div>
                                                        </div>
                                                    </div> 

                                                    
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label for="actions" class="text-right p-t-10 col-md-4">{{ __('Règles de qualité enfreintes') }}</label>
                                                            <div class="col-md-5"> 
                                                                <select id="regles" class="form-control" name="regles[]" multiple>
                                                                    @isset($anomalie)
                                                                            @foreach(App\Models\Regle::where('produit_id', '=' , $anomalie->lot->produit->id)->get() as $regle)
                                                                                <option value="{{ $regle->id }}"   
                                                                                    @if(isset($anomalie) && $anomalie->regles->contains($regle))
                                                                                        selected
                                                                                    @endif>
                                                                                    {{ $regle->titre }}
                                                                                </option>
                                                                            @endforeach
                                                                    @endisset
                                                                </select>                
                                                            </div>
                                                        </div>
                                                    </div> 

                                                    <div class="form-group">
                                                    <div class="row">
                                                    <label class="text-right p-t-10 col-md-4">Criticité</label> 
                                                    <div class="col-md-5">  
                                                    <input readonly="readonly"  type="text" class="form-control"  
                                                                    @if(isset($anomalie->criticite))
                                                                        value="{{ $anomalie->criticite}}/100" 
                                                                    @endif
                                                                    required autofocus>                                         
                                                    </div>
                                                    </div>
                                                    </div>

                                                    <div class="form-group">
                                                    <div class="row">
                                                    <label class="text-right p-t-10 col-md-4">Cause racine</label> 
                                                    <div class="col-md-5">  
                                                    <input readonly="readonly"  type="text" class="form-control" 
                                                                    @if(isset($anomalie->cause))
                                                                        value="{{ $anomalie->cause }}" 
                                                                    @endif
                                                                    required autofocus>                                         
                                                    </div>
                                                    </div>
                                                    </div>

                                                   
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
        
    

@endsection