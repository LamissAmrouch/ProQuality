@extends('main.index')

@section('content')
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row main-header">
                <div class="col-lg-8 p-0">
                    <div class="page-header">
                        <div class="page-title">
                            <h1>Traitement d'anomalie</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 p-0">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{ route('home')}}">Accueil</a></li>                    
                                <li><a href="{{ route('anomalie.dashbord')}}">Anomalies</a></li>
                                <li class="active">                        
                                    @if(!isset($anomalie))
                                        {{ __('Créer') }}
                                    @else
                                        {{ __('Modifier') }}
                                    @endif
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-content">
                <div class="card alert">
                    <div class="card-header">
                        <div class="card-body">                            
                            <div id="stepper1" class="bs-stepper">
                                <div class="bs-stepper-header">
                                    <div class="step" data-target="#test-nl-1">
                                        <button type="button" class="btn step-trigger" disabled>
                                            <span class="bs-stepper-circle" id="circle-1">1</span>
                                            <span class="bs-stepper-label" id="label-1">Brouillon</span>
                                        </button>
                                    </div>
                                    <div class="line" id="line-1"></div>
                                    <div class="step" data-target="#test-nl-2">
                                        <button type="button" class="btn step-trigger" disabled>
                                            <span class="bs-stepper-circle" id="circle-2">2</span>
                                            <span class="bs-stepper-label" id="label-2">En test</span>
                                        </button>
                                    </div>
                                    <div class="line" id="line-2"></div>
                                    <div class="step" data-target="#test-nl-3">
                                        <button type="button" class="btn step-trigger" disabled>
                                            <span class="bs-stepper-circle" id="circle-3">3</span>
                                            <span class="bs-stepper-label" id="label-3">En cours</span>
                                        </button>
                                    </div>                                        
                                    <div class="line" id="line-3"></div>
                                    <div class="step" data-target="#test-nl-4">
                                        <button type="button" class="btn step-trigger" disabled>
                                            <span class="bs-stepper-circle" id="circle-4">4</span>
                                            <span class="bs-stepper-label" id="label-4">Terminé</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="bs-stepper-content">
                                    <div id="test-nl-1" class="content">
                                        <form action="{{ route('anomalie.create-step1') }}" method="POST" >
                                            {{ csrf_field() }}
                                            @isset($anomalie)<input type="hidden" name="id" class="form-control" value="{{ $anomalie->id }}" /> @endisset
                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="titre" class="text-right p-t-10 col-md-4">{{ __('Titre') }}</label>
                                                    <div class="col-md-5">
                                                        <input id="titre" type="text" class="form-control" name="titre" 
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
                                                        <textarea name="description" class="form-control" rows="3" required autofocus>@if(isset($anomalie->description)){{ $anomalie->description }}@endif</textarea>                                         
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="type" class="text-right p-t-10 col-md-4">{{ __('Type') }}</label>
                                                    <div class="col-md-5">
                                                        <select id="typeProduit" class="form-control" name="type" onchange="showTypeProduit()">
                                                            <option value="" disabled selected>Selectionnez le type</option>
                                                            <option  @if(isset($anomalie) && $anomalie->type == 'Retour fournisseur') selected='selected' @endif value="Retour fournisseur">Retour fournisseur</option>
                                                            <option  @if(isset($anomalie) && $anomalie->type == 'Retour client') selected='selected' @endif value="Retour client">Retour client</option>
                                                            <option  @if(isset($anomalie) && $anomalie->type == 'Retour production') selected='selected' @endif  value="Retour production">Retour production</option>
                                                            </select>
                                                        </select>                                       
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="fournisseur-col" style="display:none;">
                                                <div class="row">
                                                    <label for="fournisseur" class="text-right p-t-10 col-md-4">{{ __('Fournisseur') }}</label>
                                                    <div class="col-md-5">
                                                        <select class="form-control" name="fournisseur">
                                                            <option value="" disabled selected>Selectionnez le fournisseur</option>
                                                                @foreach(App\Models\Fournisseur::all() as $fournisseur)
                                                                    <option value="{{ $fournisseur->id }}"
                                                                        @if(isset($anomalie->fournisseur) && $anomalie->fournisseur->nom == $fournisseur->nom)
                                                                            selected
                                                                        @endif 
                                                                        > {{ $fournisseur->nom }} 
                                                                    </option>
                                                                @endforeach
                                                        </select>                                  
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="form-group" id="client-col" style="display:none;">
                                                <div class="row">
                                                    <label for="client" class="text-right p-t-10 col-md-4">{{ __('Client') }}</label>
                                                    <div class="col-md-5">
                                                        <select class="form-control" name="client">
                                                            <option value="" disabled selected>Selectionnez le client</option>
                                                                @foreach(App\Models\Client::all() as $client)
                                                                    <option value="{{ $client->id }}"
                                                                        @if(isset($anomalie->client) && $anomalie->client->nom == $client->nom)
                                                                            selected
                                                                        @endif 
                                                                        > {{ $client->nom }} 
                                                                    </option>
                                                                @endforeach
                                                        </select>                                 
                                                    </div>
                                                </div>
                                            </div>     
                                            <div class="form-group" id="atelier-col" style="display:none;">
                                                <div class="row">
                                                    <label for="atelier" class="text-right p-t-10 col-md-4">{{ __('Atelier') }}</label>
                                                    <div class="col-md-5">
                                                        <select class="form-control" name="atelier">
                                                            <option value="" disabled selected>Selectionnez l'atelier</option>
                                                                @foreach(App\Models\Atelier::all() as $atelier)
                                                                    <option value="{{ $atelier->id }}"
                                                                        @if(isset($anomalie->atelier) && ($anomalie->atelier->nom == $atelier->nom))
                                                                            selected
                                                                        @endif 
                                                                        > {{ $atelier->nom }} 
                                                                    </option>
                                                                @endforeach
                                                        </select>                                
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="atelier" class="text-right p-t-10 col-md-4">{{ __('Article') }}</label>
                                                    <div class="col-md-5">
                                                        <select id="produit" class="form-control" name="produit" onchange="showCaractersticProduit()">
                                                            <option value="" disabled selected>Selectionnez le produit</option>
                                                            @if(isset($anomalie) && $anomalie->type == "Retour fournisseur" ))
                                                                @foreach(App\Models\Produit::where('type','=','Matiere premiere')->get() as $produit)
                                                                    <option value="{{ $produit->id }}"
                                                                        @if(isset($anomalie->lot->produit) && $anomalie->lot->produit->nom == $produit->nom)
                                                                        selected
                                                                        @endif   
                                                                    > {{ $produit->nom }}</option>
                                                                @endforeach
                                                            @else
                                                                @foreach(App\Models\Produit::all() as $produit)
                                                                    <option value="{{ $produit->id }}"
                                                                        @if(isset($anomalie->lot->produit) && $anomalie->lot->produit->nom == $produit->nom)
                                                                        selected
                                                                        @endif   
                                                                    > {{ $produit->nom }}</option>
                                                                @endforeach                                                                            
                                                            @endif
                                                        </select>                           
                                                    </div>
                                                </div>
                                            </div>
                                                                                     
                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="caracteristique" class="text-right p-t-10 col-md-4">{{ __('Caractéristique') }}</label>
                                                    <div class="col-md-5">
                                                        <select id="caracteristique" class="form-control" name="caracteristiquep">

                                                        @if(isset($anomalie->lot))
                                                            @foreach (App\Models\Caracteristique::where('produit_id','=',$anomalie->lot->produit->id)->get() as $c)
                                                                <option value="{{ $c->nom }}"
                                                                    @if(isset($anomalie->lot->caracteristiquep) && $anomalie->lot->caracteristiquep == $c->nom)
                                                                        selected
                                                                    @endif>
                                                                    {{ $c->nom }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                        </select>                          
                                                    </div>
                                                </div>
                                            </div>    

                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="quantite" class="text-right p-t-10 col-md-4">{{ __('Quantité') }}</label>
                                                    <div class="col-md-5">
                                                        <input type="text" id="quantite" class="form-control" name="quantite"
                                                        @if(isset($anomalie->lot->quantite))
                                                            value="{{ $anomalie->lot->quantite }}" 
                                                        @endif>                         
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="test" class="text-right p-t-10 col-md-4">{{ __('Test') }}</label>
                                                    <div class="col-md-5">
                                                        <select id="test" class="form-control" name="test" required>
                                                            <option value="" disabled selected>Selectionnez le test</option>
                                                            @foreach(App\Models\Test::all() as $test)
                                                            <option value="{{ $test->id }}"
                                                                    @if (isset($anomalie) && ($anomalie->test_id == $test->id))
                                                                    selected
                                                                    @endif   
                                                            > {{ $test->nom }}</option>
                                                            @endforeach
                                                        </select>                      
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col text-center">
                                                    <button type="submit" class="btn btn-primary btn-addon sweet-success m-t-10">
                                                        <i class="ti-angle-double-right"></i> {{ __('Suivant') }}</button> 
                                                </div>
                                            </div>
                                            @if($errors->any())
                                                @foreach ($errors->all() as $error)
                                                    <div id="error-msg" style="display: none;"> {{ $error }}
                                                    </div> 
                                                    <script>
                                                        sweetAlert(
                                                            "Erreur...", 
                                                            document.getElementById('error-msg').innerText ,
                                                            "error");
                                                    </script>
                                                @endforeach                                   
                                            @endif   
                                        </form>                                    
                                    </div>
                                    <div id="test-nl-2" class="content">
                                        <form id="form2" action="{{route('anomalie.create-step2')}}" method="POST" >
                                            {{ csrf_field() }}
                                            @isset($anomalie)<input type="hidden" name="id" class="form-control" value="{{ $anomalie->id }}" /> @endisset
                                            @isset($anomalie->test_id)
                                                @if(!empty(App\Models\Examen::where('test_id', '=' , $anomalie->test_id)->get()))
                                                <div class="card-header">
                                                    <h4>Liste des examens</h4> 
                                                </div>
                                                <table id="tableID" class="table table-responsive">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Nom</th>
                                                            <th scope="col">Type</th>
                                                            <th scope="col">Min</th>
                                                            <th scope="col">Max</th>
                                                            <th scope="col">Unité</th>                           
                                                            <th scope="col">Check </th>
                                                            <th scope="col">Valeur</th>
                                                            <th scope="col">Etat </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach(App\Models\Examen::where('test_id', '=' , $anomalie->test_id)->get() as $examen)
                                                            <tr>
                                                                <td> <input type="hidden" name="ExamensIdd[]" class="form-control" value="{{ $examen->id }}"> {{ $examen->id }}</td>
                                                                <td>{{ $examen->nom }}</td>
                                                                <td>  {{ $examen->type }}</td>
                                                                @if(isset($examen->type) && ($examen->type == "Quantitatif"))
                                                                    <td>{{ $examen->min }}</td>
                                                                    <td>{{ $examen->max }}</td>
                                                                    <td>{{ $examen->unite }}</td>
                                                                @endif
                                                                @if(isset($examen->type) && ($examen->type == "Qualitatif"))
                                                                    <td> -- </td>
                                                                    <td> -- </td>
                                                                    <td> -- </td>
                                                                @endif
                                                                <td>
                                                                    <button type="button" data-whatever="{{ $examen->id }}" data-toggle="modal" class="btn btn-info btn-sm"  
                                                                        @if(isset($examen->type) && ($examen->type == "Quantitatif")) data-target="#modalReponse2" @endif 
                                                                        @if(isset($examen->type) && ($examen->type == "Qualitatif")) data-target="#modalReponse1" @endif 
                                                                    > 
                                                                        <a style="text-decoration:none;color:#ffffff;" > 
                                                                            <i class="ti-check" aria-hidden="true"></i> 
                                                                        </a>  
                                                                    </button>     
                                                                </td>   
                                                                <td>
                                                                    <input readonly="readonly" style="border: none; border-width: 0; box-shadow: none; background:#fafafa; width:100px; height:30px; padding: 0px; outline:none;" type="text" name="ReponsesValeur[]" 
                                                                        @foreach(App\Models\Reponse::where('anomalie_id', '=' , $anomalie->id )->get() as $reponse)
                                                                            @if( ($reponse->examen_id) == ($examen->id) )
                                                                            value="{{ $reponse->valeur }}"            
                                                                            @endif                                 
                                                                        @endforeach  
                                                                    >
                                                                </td>
                                                                <td>
                                                                    <input readonly="readonly" type="hidden"  name="ReponsesEtat[]"  style="border: none; border-width: 0; box-shadow: none; background:#fafafa; width:100px; height:30px; padding: 0px;"
                                                                        @foreach(App\Models\Reponse::where('anomalie_id', '=' , $anomalie->id )->get() as $reponse)
                                                                            @if( ($reponse->examen_id) == ($examen->id) )
                                                                                @if( ($reponse->etat) == "Incorrect" )
                                                                                    value="{{ $reponse->etat }}"
                                                                                    style="border: none; border-width: 0; box-shadow: none; background:#fafafa; "
                                                                                @endif
                                                                                @if( ($reponse->etat) == "Correct" )
                                                                                    value="{{ $reponse->etat }}"
                                                                                    style="border: none; border-width: 0; box-shadow: none; background:#fafafa;color:#00ED96; "
                                                                                @endif  
                                                                            @endif                                 
                                                                        @endforeach 
                                                                    > 
                                                                    @foreach(App\Models\Reponse::where('anomalie_id', '=' , $anomalie->id )->get() as $reponse)
                                                                        @if(($reponse->examen_id) == ($examen->id))
                                                                            @if( ($reponse->etat) == "Incorrect" )
                                                                                <span  id="incorrect2" class="badge badge-danger" style="display:inline-block">Incorrect</span>
                                                                            @endif
                                                                            @if( ($reponse->etat) == "Correct" )
                                                                                <span id="correct2"  class="badge badge-success" style="display:inline-block">Correct</span>
                                                                            @endif  
                                                                        @endif                                 
                                                                    @endforeach 
                                                                    <span id="incorrect" class="badge badge-danger" style="display:none">Incorrect</span>
                                                                    <span id="correct" class="badge badge-success" style="display:none">Correct</span>
                                                                </td> 
                                                            </tr>                     
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="row">
                                                    <div class="col text-center">
                                                        @isset($anomalie)
                                                        <a href="{{ route('anomalie.previous',$anomalie)}}">
                                                            <button type="button" class="btn btn-warning btn-addon m-b-10 m-l-5">
                                                                <i class="ti-angle-double-left"></i> {{ __('Précedent') }}
                                                            </button>                 
                                                        </a>
                                                        @endisset
                                                        <button onclick="verifyExams()" class="btn btn-primary sweet-success btn-addon m-b-10 m-l-5" type="button">
                                                            <i class="ti-angle-double-right"></i>{{ __('Suivant') }}
                                                        </button> 
                                                    </div>
                                                </div>  
                                                @endif
                                            @endisset
                                        </form>  
                                    </div>                                      
                                    <div id="test-nl-3" class="content">
                                        <form action="{{route('anomalie.create-step3')}}" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            @isset($anomalie)<input type="hidden" name="id" class="form-control" value="{{ $anomalie->id }}" /> @endisset
                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="actions" class="text-right p-t-10 col-md-4">{{ __('Actions') }}</label>
                                                    <div class="col-md-5">
                                                        <select id="actions" class="form-control"  name="actions[]" multiple required>
                                                            <option value="" disabled selected>Choisir/Introduire les actions</option>
                                                            @foreach(App\Models\Action::all() as $action)
                                                                <option value="{{ $action->id }}"   
                                                                    @if( isset($anomalie->actions) && $anomalie->actions->contains($action))
                                                                        selected
                                                                    @endif>
                                                                    {{ $action->designation }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="text-right">
                                                        <button type="button" class="btn btn-info btn-addon m-b-10" data-toggle="modal" id="modal-toggle" 
                                                        data-target="#modalAddAction"><i class="ti-plus"></i>Créer une action</button></div>             
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="diagnostique" class="text-right p-t-10 col-md-4">{{ __('Diagnostic') }}</label>
                                                    <div class="col-md-5">
                                                        <textarea name="diagnostique" class="form-control" rows="3" required autofocus>@if(isset($anomalie->diagnostique)){{ $anomalie->diagnostique }}@endif</textarea>
                                                                         
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-5">
                                                        <div class="checkbox">
                                                            <label id="reparer">
                                                                <input name="reparer" type="checkbox">Necessite une réparation ?
                                                            </label>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                          
                                            <div class="form-group reparateur-row"  style="display:none;">
                                                <div class="row">	
                                                    <label for="reparateur" class="text-right p-t-10 col-md-4">{{ __('Réparateur') }}</label>	
                                                    <div class="col-md-5">
                                                        <select id="reparateur" class="form-control" name="reparateur">	                                                        
                                                            <option value="" disabled selected>Choisir le réparateur</option>	                                                        
                                                            @foreach(App\User::where('service', '=' , 'Réparation')->get() as $user)	                                                        
                                                                <option value="{{ $user->id }}"	                                                                    
                                                                    @if(isset($anomalie->reparateur_id) && $anomalie->reparateur->nom == $user->nom )	                                                    
                                                                        selected	                                                
                                                                    @endif	                                            
                                                                    >{{ $user->nom  }} {{ $user->prenom  }}</option>	                                            
                                                            @endforeach	                                                
                                                        </select>	                                                           
                                                    </div>  
                                                </div>  
                                            </div>

                                            <div class="form-group reparateur-row"  style="display:none;" >
                                                <div class="row">
                                                    <label for="productimg" class="text-right p-t-10 col-md-4">{{ __('Fiche de réparation') }}</label>
                                                    <div class="col-md-5">
                                                        @if(isset($anomalie->productimg))
                                                        <div id="fiche">
                                                            <a href="{{ asset('storage/app/ficheReparation/'.$anomalie->productimg) }}" target="_blank">
                                                                <img src="{{ asset('storage/app/ficheReparation/'.$anomalie->productimg) }}" /></a>
                                                        </div>
                                                        @endif
                                                        <input type="file" class="form-control-file" name="productimg" id="productimg" 
                                                        aria-describedby="fileHelp">
                                                        <small id="fileHelp" class="form-text text-muted">Veuillez choisir un fichier valide
                                                            (jpeg,png,jpg,gif,svg). 
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <div class="row">
                                                <div class="col text-center">
                                                    @isset($anomalie)
                                                    <a href="{{ route('anomalie.previous',$anomalie)}}">
                                                        <button type="button" class="btn btn-warning btn-addon m-b-10 m-l-5">
                                                            <i class="ti-angle-double-left"></i> {{ __('Précedent') }}
                                                        </button>                 
                                                    </a>
                                                    @endisset
                                                    <button class="btn btn-primary sweet-success btn-addon m-b-10 m-l-5" type="submit">
                                                        <i class="ti-angle-double-right"></i>{{ __('Suivant') }}
                                                    </button> 
                                                </div>
                                            </div>
                                            @if($errors->any())
                                                @foreach ($errors->all() as $error)
                                                    <div id="error-msg" style="display: none;"> {{ $error }}
                                                    </div> 
                                                    <script>
                                                        sweetAlert(
                                                            "Erreur...", 
                                                            document.getElementById('error-msg').innerText ,
                                                            "error");
                                                    </script>
                                                @endforeach                                   
                                            @endif                                         
                                        </form>                                     
                                    </div>
                                    <div id="test-nl-4" class="content">
                                        <form action="{{route('anomalie.create-step4')}}" method="POST" >
                                            {{ csrf_field() }}
                                            @isset($anomalie)<input type="hidden" name="id" class="form-control" value="{{ $anomalie->id }}" /> @endisset
                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="regles" class="text-right p-t-10 col-md-4">{{ __('Règles de qualité enfreintes') }}</label>
                                                    <div class="col-md-5">
                                                        <select id="regles" class="form-control" name="regles[]" multiple>
                                                            <option value="" disabled selected>Choisir les règles qualité</option>
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
                                                        <div class="text-right">
                                                        <button type="button" class="btn btn-info btn-addon m-b-10" data-toggle="modal" id="modal-toggle" 
                                                        data-target="#modalAddRegle"><i class="ti-plus"></i>Créer une règle</button></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="criticite" class="text-right p-t-10 col-md-4">{{ __('Criticité') }}</label>
                                                    <div class="col-md-5">
                                                        <div class="rangeslider">
                                                            <div>
                                                                <input type="text" id="criticite"
                                                                @isset($anomalie->criticite) value="{{$anomalie->criticite}}"  @endisset 
                                                                name="criticite" />
                                                            </div>
                                                        </div>           
                                                    </div>           
                                                </div>           
                                            </div>           
                                           
                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="cause" class="text-right p-t-10 col-md-4">{{ __('Cause racine') }}</label>
                                                    <div class="col-md-5">
                                                        <textarea name="cause" class="form-control" rows="3" required autofocus>@if(isset($anomalie->cause)){{ $anomalie->cause }}@endif</textarea>
                                                    </div>
                                                </div>
                                            </div>       
                                            <div class="row">
                                                <div class="col text-center">
                                                    @isset($anomalie)
                                                    <a href="{{ route('anomalie.previous',$anomalie)}}">
                                                        <button type="button" class="btn btn-warning btn-addon m-b-10 m-l-5">
                                                            <i class="ti-angle-double-left"></i> {{ __('Précedent') }}
                                                        </button>                 
                                                    </a>
                                                    @endisset
                                                    <button class="btn btn-primary sweet-success btn-addon m-b-10 m-l-5" type="submit">
                                                        <i class="ti-angle-double-right"></i>{{ __('Enregistrer') }}
                                                    </button> 
                                                </div>
                                            </div>
                                            @if($errors->any())
                                                @foreach ($errors->all() as $error)
                                                    <div id="error-msg" style="display: none;"> {{ $error }}
                                                    </div> 
                                                    <script>
                                                        sweetAlert(
                                                            "Erreur...", 
                                                            document.getElementById('error-msg').innerText ,
                                                            "error");
                                                    </script>
                                                @endforeach                                   
                                            @endif    
                                        </form>                                        
                                    </div>
                                    @if($errors->any())
                                            @foreach ($errors->all() as $error)
                                                <div id="error-msg" style="display: none;"> {{ $error }}
                                                </div> 
                                                <script>
                                                    sweetAlert(
                                                        "Erreur...", 
                                                        document.getElementById('error-msg').innerText ,
                                                        "error");
                                                </script>
                                            @endforeach                                   
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</div>
<div class="modal fade" id="modalReponse1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="exampleModalLabel">Répondre à l'examen</h4>
            </div>
            <div class="modal-body">
                  <div class="basic-form">                                            
                    <div class="form-group">
                      <input type="hidden" class="form-control" name="ExamId" id="ExamenId1">
                    </div>  
                    <div class="form-group" >
                        <label>La réponse</label>                                           
                        <select id="reponseV" class="form-control" name="reponse" onchange="" required>
                            <option value="" disabled selected>Sélectionnez la bonne réponse</option>
                            <option value="Fonctionnel">Fonctionnel</option>
                            <option value="Non Fonctionnel">Non Fonctionnel</option>
                            <option value="Présent">Présent</option>
                            <option value="Non Présent">Non Présent</option>
                        </select>  
                    </div>
                      
                  </div>
             </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" onclick='Repondre1()' data-dismiss="modal" class="btn btn-primary">Enregistrer</button>
              </div>
          </div>
        </div>
</div> 

<div class="modal fade" id="modalReponse2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="exampleModalLabel">Répondre à l'examen</h4>
            </div>
            <div class="modal-body">
                  <div class="basic-form">                                      
                     
                    <div class="form-group">
                      <input type="hidden" class="form-control" name="ExamId" id="ExamenId2">
                    </div>        
                    <div class="form-group">
                        <div class="row"> 
                            <label class="text-right p-t-10 col-md-3">La valeur </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="valeur" id="val" required>
                            </div>  
                        </div> 
                    </div>
                  </div>
             </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" id="btnRepondre2" onclick='Repondre2()' data-dismiss="modal" class="btn btn-primary">Enregistrer</button>
              </div>
          </div>
        </div>
</div> 

    <div class="modal fade" id="modalAddAction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Ajouter une action</h4>
                </div>
                <div class="modal-body">
                    <div class="basic-form">                           
                        <form id="AddActionForm" action="{{ route('action.store') }}" method="POST">
                            {{ csrf_field() }}               
                            @isset($anomalie)<input type="hidden" name="id" class="form-control" value="{{ $anomalie->id }}" /> @endisset
                            
                            <div class="form-group">
                            <div class="row">
                                <label class="text-right p-t-10 col-md-3">Type</label>  
                                <div class="col-md-9">                                         
                                <select id="type" class="form-control" name="type" required>
                                    <option value="corrective" selected>Corrective</option>
                                    <option value="preventive">Préventive</option>
                                </select>
                            </div>
                            </div>
                            </div>

                            <div class="form-group">
                            <div class="row">
                                <label class="text-right p-t-10 col-md-3">Designation</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control" name="designation" id="designation" required>
                                </div>
                            </div>
                            </div>

                            <div class="form-group">
                            <div class="row">
                                <label class="text-right p-t-10 col-md-3">Description</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="description" id="description" >
                            </div>
                            </div>
                            </div>

                            <div class="form-group">
                            <div class="row">
                                <label class="text-right p-t-10 col-md-3">Résultat</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="resultat" id="resultat" required>
                            </div>
                            </div>
                            </div>
  

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>  
        </div>  
    </div> 


    <div class="modal fade" id="modalAddRegle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Ajouter une règle qualité</h4>
            </div>
            <div class="modal-body">
                <div class="basic-form">                           
                    <form id="AddRegleForm" action="{{ route('regle.store') }}" method="POST">
                        {{ csrf_field() }}               
                        @isset($anomalie)<input type="hidden" name="id" class="form-control" value="{{ $anomalie->id }}" /> @endisset
                        <div class="form-group">
                            <div class="row">
                                <label class="text-right p-t-10 col-md-2">Titre</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="titre" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label  class="text-right p-t-10 col-md-2">Article </label>  
                                <div class="col-md-10"> 
                                    @isset($anomalie)                                        
                                    <select id="produit" class="form-control" name="produit" required>
                                        <option value="{{ $anomalie->lot->produit->id }}" selected>{{ $anomalie->lot->produit->nom }}</option>
                                    </select>
                                    @endisset
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label  class="text-right p-t-10 col-md-2">Contenu</label>
                                <div class="col-md-10">
                                    <textarea name="contenu" class="form-control" rows="3" required></textarea>
                                </div> 
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>  
    </div>  
</div> 

@endsection