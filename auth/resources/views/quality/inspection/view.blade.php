@extends('main.index')

@section('content')
    <div class="content-wrap">
        <div class="main">
           <div class="container-fluid">
                <div class="row main-header">
                    <div class="col-lg-8 p-0">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Gestion des inspections</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 p-0">
                        <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{ route('home')}}">Accueil</a></li>                    
                                <li><a href="{{ route('inspection.dashbord')}}">inspections</a></li>
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
                            <h4> {{ __('Consultation inspection') }} </h4>
                            </div>

                            <div class="col-lg-6">
                                        <div class="text-right"> 
                                         @if(isset($inspection))
                                                <a target="_blank" href="{{ route('inspection.pdf',$inspection)}}">
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
                                                                    @if(isset($inspection->titre))
                                                                        value="{{ $inspection->titre }}" 
                                                                    @endif
                                                                    required autocomplete="titre" autofocus>
                                                    </div>
                                                    </div>
                                                        </div>

                                                    <div class="form-group">
                                                     <div class="row">
                                                    <label for="date" class="text-right p-t-10 col-md-4">{{ __('Date') }}</label>
                                                    <div class="col-md-5">
                                                        <input readonly="readonly" id="date" type="datetime-local" class="form-control" name="date" 
                                                        @if(isset($inspection))
                                                            <?php
                                                                $event = App\Models\Event::where('inspection_id', '=' , $inspection->id)->first();
                                                            ?>
                                                            value="{{ date('Y-m-d\TH:i', strtotime($event->start)) }}"
                                                        @endif 
                                                        required autocomplete="date" autofocus>                                 
                                                     </div>
                                                     </div>
                                                     </div>

                                                    <div class="form-group">
                                                    <div class="row">
                                                        <label for="description" class="text-right p-t-10 col-md-4">{{ __('Description') }}</label>
                                                        <div class="col-md-5">
                                                        <textarea readonly="readonly" name="description" class="form-control" rows="3" required autofocus>@if(isset($inspection->description)){{ $inspection->description }}@endif</textarea>
                                                        </div>
                                                    </div>
                                                    </div>
 
                                                    <div class="form-group">
                                                    <div class="row">
                                                    <label class="text-right p-t-10 col-md-4">Article</label> 
                                                    <div class="col-md-5">            
                                                    <input readonly="readonly" type="text" class="form-control"  
                                                                    @if(isset($inspection->lot))
                                                                        value="{{ $inspection->lot->produit->nom}} de type {{ $inspection->lot->caracteristiquep }}" 
                                                                    @endif
                                                                    required autofocus> 
                                                    </div>
                                                    </div>
                                                    </div>

                                                    <div class="form-group">
                                                    <div class="row">
                                                    <label class="text-right p-t-10 col-md-4">Quantité à inspecter</label> 
                                                    <div class="col-md-5">            
                                                    <input readonly="readonly" type="text" class="form-control"  
                                                                    @if(isset($inspection->lot))
                                                                        value="{{ $inspection->lot->quantite}}" 
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
                                                                    @if(isset($inspection->test))
                                                                        value="{{ $inspection->test->nom}}" 
                                                                    @endif
                                                                    required autofocus> 
                                                    </div>
                                                    </div>
                                                    </div>

                                                    <div class="form-group">
                                                    <div class="row">
                                                    <label class="text-right p-t-10 col-md-4">Quantité défectueuse</label> 
                                                    <div class="col-md-5">            
                                                    <input readonly="readonly" type="text" class="form-control"  
                                                                    @if(isset($inspection->test))
                                                                        value="{{$inspection->quantiteD }}" 
                                                                    @endif
                                                                    required autofocus> 
                                                    </div>
                                                    </div>
                                                    </div>
                                                                        
                                                    <div class="form-group">
                                                    <div class="row">
                                                    <label class="text-right p-t-10 col-md-4">Résultat</label> 
                                                    <div class="col-md-5">  
                                                    <input readonly="readonly" id="resultats" type="text" class="form-control" name="resultats" 
                                                                    @if(isset($inspection->resultats))
                                                                        value="{{ $inspection->resultats}}" 
                                                                    @endif
                                                                    required autofocus>                                         
                                                    </div>
                                                    </div>
                                                    </div>

                                                    <div class="form-group">
                                                    <div class="row">
                                                        <label for="commentaire" class="text-right p-t-10 col-md-4">{{ __('Commentaire') }}</label>
                                                        <div class="col-md-5">
                                                        <textarea readonly="readonly" name="commentaire" class="form-control" rows="3"  autofocus>@if(isset($inspection)){{ $inspection->commentaire }}@endif</textarea>
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