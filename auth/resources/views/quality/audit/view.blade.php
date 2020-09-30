@extends('main.index')

@section('content')
    <div class="content-wrap">
        <div class="main">
           <div class="container-fluid">
                <div class="row main-header">
                    <div class="col-lg-8 p-0">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Gestion des audits</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 p-0">
                        <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{ route('home')}}">Accueil</a></li>                    
                                <li><a href="{{ route('audit.dashbord')}}">audits</a></li>
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
                            <h4> {{ __('Consultation audit') }} </h4>
                            </div>

                            <div class="col-lg-6">
                                        <div class="text-right"> 
                                         @if(isset($audit))
                                                <a target="_blank" href="{{ route('audit.pdf',$audit)}}">
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
                                                                    @if(isset($audit->titre))
                                                                        value="{{ $audit->titre }}" 
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
                                                        @if(isset($audit))
                                                            <?php
                                                                $event = App\Models\Event::where('audit_id', '=' , $audit->id)->first();
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
                                                        <textarea readonly="readonly" name="description" class="form-control" rows="3" required autofocus>@if(isset($audit->description)){{$audit->description}}@endif</textarea>                                                       
                                                    </div>
                                                    </div>
                                                    </div>
 
                                                    <div class="form-group">
                                                    <div class="row">
                                                    <label class="text-right p-t-10 col-md-4">Procédé</label> 
                                                    <div class="col-md-5">            
                                                    <input readonly="readonly" id="procede" type="text" class="form-control" name="procede" 
                                                                    @if(isset($audit->procede))
                                                                        value="{{ $audit->procede->designation }}" 
                                                                    @endif
                                                                    autofocus> 
                                                    </div>
                                                    </div>
                                                    </div>
                                                                        
                                                    <div class="form-group">
                                                    <div class="row">
                                                    <label class="text-right p-t-10 col-md-4">Résultat</label> 
                                                    <div class="col-md-5">  
                                                    <input readonly="readonly" id="resultats" type="text" class="form-control" name="resultats" 
                                                                    @if(isset($audit->resultats))
                                                                        value="{{ $audit->resultats}}" 
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
                                                                                @if( isset($audit->actions) && $audit->actions->contains($action))
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
                                                            <label for="regles" class="text-right p-t-10 col-md-4">{{ __('Régles de qualité') }}</label>
                                                            <div class="col-md-5"> 
                                                                <select readonly="readonly" id="regles" class="form-control"  name="regles[]" multiple>
                                                                        @foreach(App\Models\Regle::all() as $regle)
                                                                            <option value="{{ $regle->id }}"   
                                                                                @if( isset($audit->regles) && $audit->regles->contains($regle))
                                                                                    selected
                                                                                @endif>
                                                                                {{ $regle->titre }}
                                                                            </option>
                                                                        @endforeach
                                                                </select>                 
                                                            </div>
                                                        </div>
                                                    </div> 


                                                    <div class="form-group">
                                                    <div class="row">
                                                        <label for="commentaire" class="text-right p-t-10 col-md-4">{{ __('Commentaire') }}</label>
                                                        <div class="col-md-5">
                                                        <textarea readonly="readonly" name="commentaire" class="form-control" rows="3"  autofocus>@if(isset($audit)){{ $audit->commentaire }}@endif</textarea>
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