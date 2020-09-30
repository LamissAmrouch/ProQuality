@extends('main.index')

@section('content')
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row main-header">
                    <div class="col-lg-8 p-0">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Gestion des règles qualités</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-0">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="{{ route('home')}}">Accueil</a></li>                    
                                    <li><a href="{{ route('regle.list')}}">Règles de qualité</a></li>
                                    <li class="active">                        
                                        @if(!isset($regle))
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
                                    <h4>
                                     @if(!isset($regle))
                                       {{ __('Création de la règle qualité') }}
                                      @else
                                       {{ __('Modification de la règle qualité') }}
                                     @endif</h4>
                                </div><br><br>
                              <div class="card-body">
                                 <div class="basic-form">
                                    <form action="{{ $action }}" method="POST"> 
                                        {{ csrf_field()}}
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="titre" class="text-right p-t-10 col-md-4">{{ __('Titre') }}</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" name="titre"
                                                    @if(isset($regle))
                                                        value="{{ $regle->titre }}" 
                                                    @endif required>                  
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="article" class="text-right p-t-10 col-md-4">{{ __('Article') }}</label>
                                                <div class="col-md-5">
                                                    <select id="produit" class="form-control" name="produit"  required>
                                                        <option value="" disabled selected>Sélectionnez le produit</option>
                                                          @foreach($produits as $produit)
                                                          <option value="{{ $produit->id }}"
                                                            @if (isset($regle) && ($regle->produit->nom == $produit->nom))
                                                            selected
                                                            @endif   
                                                          > {{ $produit->nom }}</option>
                                                           @endforeach
                                                    </select>                 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="contenu" class="text-right p-t-10 col-md-4">{{ __('Contenu') }}</label>
                                                <div class="col-md-5">
                                                    <textarea name="contenu" class="form-control" rows="3" required>@if(isset($regle)){{ $regle->contenu }}@endif</textarea>                  
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col text-center">
                                                <button class="btn btn-primary sweet-success btn-addon m-b-10 m-l-5" type="submit">
                                                    <i class="ti-save"></i>{{ __('Enregistrer') }}
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
                        </div>
                    </div>      
                </div>  
            </div>          
        </div>    
    </div> 
 @endsection

