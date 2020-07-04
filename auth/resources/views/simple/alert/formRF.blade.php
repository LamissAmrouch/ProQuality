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
                          <li><a href="{{ route('alertRF.list')}}">Alertes retours marchandise</a></li>
                          <li class="active">  
                            @if(!isset($alert))
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
          <div class="row p-r-0 p-l-0 ">
              <div class="col-md-12">
                  <div class="card alert">
                      <div class="card-header">
                                  <h4>
                                   @if(!isset($alert))
                                     {{ __('Créer alerte retour fournisseur') }}
                                    @else
                                     {{ __('Modifier alerte retour fournisseur') }}
                                   @endif</h4>
                              </div>
                              <br>   
                              <br>
                              <div class="card-body">
                                 <div class="basic-form">
                                    <form action="{{ $action }}" method="POST"> 
                                        {{ csrf_field()}}
                                            <div class="form-group">
                                              <div class="row" id="produit">
                                                  <label class="text-right p-t-10 col-md-4">Matière Première</label>
                                                  <div class="col-md-5">                                           
                                                    <select class="form-control" name="produit" required>
                                                        <option value="" disabled selected>Selectionnez l'article</option>
                                                          @foreach(App\Models\Produit::where('type','=','Matiere premiere')->get() as $produit)
                                                          <option value="{{ $produit->id }}"
                                                            @if (isset($alert) && ($alert->lot->produit->nom == $produit->nom))
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
                                                <label class="text-right p-t-10 col-md-4">Quantité</label>
                                                <div class="col-md-5">                                           
                                                  <input type="text" class="form-control" name="quantite"
                                                    @if(isset($alert))
                                                    value="{{ $alert->lot->quantite }}" 
                                                    @endif 
                                                    >
                                                </div>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <div class="row">
                                                <label class="text-right p-t-10 col-md-4">Fournisseur</label>
                                                <div class="col-md-5">                                           
                                                  <select class="form-control" name="fournisseur" required>
                                                  <option value="" disabled selected>Selectionnez le fournisseur</option>
                                                    @foreach(App\Models\Fournisseur::all() as $fournisseur)
                                                      <option value="{{ $fournisseur->id }}"
                                                        @if (isset($alert) && ($alert->fournisseur->nom == $fournisseur->nom))
                                                        selected
                                                        @endif > {{ $fournisseur->nom }} </option>
                                                      @endforeach
                                                  </select>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="form-group" id="motif">
                                              <div class="row">
                                                <label class="text-right p-t-10 col-md-4">Motif de retour</label>
                                                <div class="col-md-5">                                           
                                                  <input type="text" class="form-control" name="motif"
                                                    @if(isset($alert))
                                                    value="{{ $alert->motif }}" 
                                                    @endif>
                                                </div>
                                              </div>
                                            </div> 
                                            <div class="form-group" id="motif">
                                              <div class="row">
                                                <label class="text-right p-t-10 col-md-4">Description</label>
                                                <div class="col-md-5">
                                                  <textarea name="description" class="form-control" rows="4">  
                                                    @if(isset($alert))
                                                    {{ $alert->description }}
                                                    @endif
                                                </textarea>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="row">
                                                <div class="col text-center">
                                                    <button type="submit" class="btn btn-primary btn-addon sweet-success m-t-10">
                                                    <i class="ti-save"></i>Enregistrer</button> 
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
                  </div>          
                </div>    
 @endsection

