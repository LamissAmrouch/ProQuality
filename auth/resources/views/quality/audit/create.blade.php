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
                                    @if(!isset($audit))
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
                            <div id="stepper3" class="bs-stepper">
                                <div class="bs-stepper-header">
                                    <div class="step" data-target="#test-nl-1">
                                        <button type="button" class="btn step-trigger" disabled>
                                            <span class="bs-stepper-circle" id="circle-1">1</span>
                                            <span class="bs-stepper-label" id="label-1">Créer</span>
                                        </button>
                                    </div>
                                    <div class="line" id="line-1"></div>
                                    <div class="step" data-target="#test-nl-2">
                                        <button type="button" class="btn step-trigger" disabled>
                                            <span class="bs-stepper-circle" id="circle-2">2</span>
                                            <span class="bs-stepper-label" id="label-2">En cours</span>
                                        </button>
                                    </div>
                                    <div class="line" id="line-2"></div>
                                    <div class="step" data-target="#test-nl-3">
                                        <button type="button" class="btn step-trigger" disabled>
                                            <span class="bs-stepper-circle" id="circle-3">3</span>
                                            <span class="bs-stepper-label" id="label-3">Terminé</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="bs-stepper-content">
                                    <div id="test-nl-1" class="content">
                    
                                        <form action="{{ route('audit.create-step1') }}" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            
                                            @isset($audit)<input type="hidden" name="id" class="form-control" value="{{ $audit->id }}" /> @endisset
                                                  
                                                    <div class="form-group">
                                                    <div class="row">
                                                        <label for="titre" class="text-right p-t-10 col-md-4">{{ __('Titre') }}</label>
                                                        <div class="col-md-5">
                                                        <input id="titre" type="text" class="form-control" name="titre" 
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
                                                        <input id="date" type="datetime-local" class="form-control" name="date" 
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
                                                        <textarea name="description" class="form-control" rows="3" required autofocus>@if(isset($audit->description)){{$audit->description}}@endif</textarea>
                                                        </div>
                                                    </div>
                                                    </div>
 
                                                    <div class="form-group">
                                                    <div class="row">
                                                    <label class="text-right p-t-10 col-md-4">Procédé</label> 
                                                    <div class="col-md-5">                                          
                                                    <select id="procede" class="form-control" name="procede" required>
                                                    <option value="" disabled selected>Sélectionnez le procédé</option>
                                                            @foreach(App\Models\Procede::all() as $procede)
                                                            <option value="{{ $procede->id }}"
                                                                @if (isset($audit) && ($audit->procede_id == $procede->id))
                                                                selected
                                                                @endif> {{ $procede->designation }}</option>
                                                            @endforeach
                                                    
                                                    </select>
                                                    </div>
                                                    </div>
                                                    </div>
                                                 
   

                                                    <div class="form-group">
                                                       <div class="row">
                                                       <div class="col text-center">
                                                        <button type="submit" class="btn btn-primary btn-addon sweet-success m-t-10">
                                                            <i class="ti-angle-double-right"></i> {{ __('Suivant') }}
                                                        </button> 
                                                       </div>
                                                     </div>
                                                    </div>

                                                    <div class="card-header-right-icon"><ul></ul></div> 
                                            </form>                                     
                                    </div>
                                    <div id="test-nl-2" class="content">
                                        <form id="form2" action="{{route('audit.create-step2')}}" method="POST" >
                                            {{ csrf_field() }}
                                            @isset($audit) <input type="hidden" name="id" class="form-control" value="{{ $audit->id }}" /> @endisset

                                            <div class="card-header">
                                            <h4>Questionnaire de l'audit</h4> </div>
                                            <div class="invoicelist-body">
                                                <table class="table table-responsive">
                                                    <thead>
                                                        <tr>
                                                            <th>Question</th>
                                                            <th class="w12pr">Réponse</th>	
                                                            <th class="w12pr">Remarque </th>										
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if(isset($audit) && (!empty($audit)) )
                                                    @foreach(App\Models\Questionnaire::where('audit_id', '=' , $audit->id)->get() as $questionnaire)
                                                    <tr> <input name="IdQ[]" type="hidden" value="{{ $questionnaire->id}}"/> 
                                                        <td class="amount"><a class="control removeRow" href="#" 
                                                        >x</a> <input name="questions[]" type="text" value="{{ $questionnaire->question}}"/></td> <td class="amount"> <input name="reponses[]" type="text" value="{{ $questionnaire->reponse}}"/></td> <td class="amount"><input name="remarques[]" type="text" value="{{ $questionnaire->remarque}}"/>
                                                        </td> 
                                                    </tr>
                                                    @endforeach 
                                                    @endif 
                                                <!-- <td><a class="control removeRow" href="#">x</a> <span contenteditable> T Shirt</span></td> -->
                                                   
                                                <!--<td class="amount">
                                                    <a class="control removeRow" href="#">x</a>
                                                       <input type="text" value="La" /> 
                                                        <span contenteditable> La politique qualité est-elle communiquée au sein de l’organisme ?</span> 
                                                    </td>

                                                    <td class="amount">
                                                        <input type="text" value="Oui" />
                                                    </td>

                                                    <td class="amount">
                                                        <input type="text" value="" />
                                                    </td> -->
                                                    </tbody>
                                                </table>
                                                <a class="control newRow" href="#">+ Ajouter une question</a>
                                            </div>
                                            <!--.invoice-body-->
                                                <br><br>
                                                <div class="row">
                                                     <div class="col text-center">
                                                        @isset($audit)
                                                            <a href="{{ route('audit.previous',$audit)}}">
                                                                <button type="button" class="btn btn-warning btn-addon m-b-10 m-l-5">
                                                                    <i class="ti-angle-double-left"></i>  {{ __('Précedent') }}
                                                                </button>                 
                                                            </a> 
                                                        @endisset
                                                        <button id="suivant2" class="btn btn-primary sweet-success btn-addon m-b-10 m-l-5" type="submit"  >
                                                             <i class="ti-angle-double-right"></i>     {{ __('Suivant') }}
                                                        </button> 
                                                    </div>
                                                </div>
                                                <div class="card-header-right-icon"><ul></ul></div> 
                                        </form> 
                                    </div>

                                    <div id="test-nl-3" class="content">
                                        <form action="{{route('audit.create-step3')}}" method="POST" >
                                            {{ csrf_field()   }}
                                                  @isset($audit)<input type="hidden" name="id" class="form-control" value="{{ $audit->id }}" /> @endisset
                                                     
                            
                                                    <div class="form-group">
                                                    <div class="row">
                                                    <label class="text-right p-t-10 col-md-4">Résultat</label> 
                                                    <div class="col-md-5">                                          
                                                    <select id="resultats" class="form-control" name="resultats" required>
                                                    <option value="" disabled selected>Choisir le résultat</option>
                                                    <option value="Procédé conforme" @if(isset($audit->resultats) && $audit->resultats == "Procédé conforme") selected @endif >Procédé conforme</option>
                                                    <option value="Procédé non conforme" @if(isset($audit->resultats) && $audit->resultats == "Procédé non conforme") selected @endif>Procédé non conforme</option>                 
                                                    </select>
                                                    </div>
                                                    </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label for="actions" class="text-right p-t-10 col-md-4">{{ __('Actions') }}</label>
                                                            <div class="col-md-5">
                                                                <select id="actions" class="form-control"  name="actions[]" multiple>
                                                                    <option value="" disabled selected>Choisir/Introduire les actions</option>
                                                                    @foreach(App\Models\Action::all() as $action)
                                                                        <option value="{{ $action->id }}"   
                                                                            @if( isset($audit->actions) && $audit->actions->contains($action))
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
                                                            <label for="regles" class="text-right p-t-10 col-md-4">{{ __('Règles de qualité') }}</label>
                                                            <div class="col-md-5">
                                                                <select id="regles" class="form-control" name="regles[]" multiple>
                                                                    <option value="" disabled selected>Choisir les règles qualité</option>
                                                                    @isset($audit->procede)
                                                                            @foreach(App\Models\Regle::where('produit_id', '=' , $audit->procede->produit->id)->get() as $regle)
                                                                                <option value="{{ $regle->id }}"   
                                                                                    @if(isset($audit) && $audit->regles->contains($regle))
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
                                                        <label for="commentaire" class="text-right p-t-10 col-md-4">{{ __('Commentaire') }}</label>
                                                        <div class="col-md-5">
                                                        <textarea name="commentaire" class="form-control" rows="3"  autofocus>@if(isset($audit)){{$audit->commentaire}}@endif</textarea>
                                                        </div>
                                                    </div>
                                                    </div>


                                                    <div class="row">
                                                     <div class="col text-center">
                                                        @isset($audit)
                                                            <a href="{{ route('audit.previous',$audit)}}">
                                                                <button type="button" class="btn btn-warning btn-addon m-b-10 m-l-5">
                                                                <i class="ti-angle-double-left"></i>   {{ __('Précedent') }}
                                                                </button>                 
                                                            </a> 
                                                        @endisset
 
                                                        <button class="btn btn-primary sweet-success btn-addon m-b-10 m-l-5" type="submit">
                                                        <i class="ti-save"></i>   {{ __('Enregistrer') }}
                                                        </button>  
                                                    </div>
                                                  </div>

                                                    <div class="card-header-right-icon"><ul></ul></div> 
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
                            @isset($audit)<input type="hidden" name="idAudit" class="form-control" value="{{ $audit->id }}" /> @endisset
                            
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
                                <input type="text" class="form-control" name="description" id="description" required>
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
                            @isset($audit)<input type="hidden" name="idAudit" class="form-control" value="{{ $audit->id }}" /> @endisset
                            
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
                                <select id="produit" class="form-control" name="produit"  required>
                                    <option value="" disabled selected>Sélectionnez l'article</option>
                                    @foreach(App\Models\Produit::all() as $produit)
                                        <option value="{{ $produit->id }}">{{ $produit->nom }}</option>
                                    @endforeach
                                </select>
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