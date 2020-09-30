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
                                <li><a href="{{ route('alertRC.list')}}">Alertes retour client</a></li>
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
                <div class="col-lg-12 p-r-0 p-l-0">
                    <div class="card alert">
                        <div class="card-header">
                            <h4>
                              @if(!isset($alert))
                                {{ __('Création Alerte retour client') }}
                              @else
                                {{ __('Modification Alerte retour client') }}
                              @endif
                            </h4>
                        </div><br><br>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ $action }}" method="POST"> 
                                    {{ csrf_field()}}
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="text-right p-t-10 col-md-4">Client</label>
                                            <div class="col-md-5">
                                                <select class="form-control" name="client" required>
                                                    <option value="" disabled selected>Selectionnez le client</option>
                                                      @foreach(App\Models\Client::all() as $client)
                                                      <option value="{{ $client->id }}"
                                                        @if (isset($alert) && ($alert->client->nom == $client->nom))
                                                        selected
                                                        @endif 
                                                      > {{ $client->nom }} </option>
                                                      @endforeach
                                              </select> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="text-right p-t-10 col-md-4">Produit Fini</label>
                                            <div class="col-md-5">                                           
                                                <select id="produit" class="form-control" name="produit"  onchange="showCaractersticProduit()">
                                                  <option value="" disabled selected>Selectionnez le produit</option>
                                                  @foreach(App\Models\Produit::where('type','=','Fini')->get() as $produit)
                                                  <option value="{{ $produit->id }}"
                                                      @if (isset($alert) && ($alert->lot->produit->nom == $produit->nom))
                                                        selected
                                                      @endif> {{ $produit->nom }}</option>
                                                  @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="text-right p-t-10 col-md-4">Caractéristique</label>
                                            <div class="col-md-5">                                           
                                                <select id="caracteristique" class="form-control" name="caracteristiquep">
                                                    @if(isset($alert->lot))
                                                        @foreach (App\Models\Caracteristique::where('produit_id','=',$alert->lot->produit->id)->get() as $c)
                                                            <option value="{{ $c->nom }}"
                                                                @if(isset($alert->lot->caracteristiquep) && $alert->lot->caracteristiquep == $c->nom)
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
                                            <label class="text-right p-t-10 col-md-4">Quantité</label>
                                            <div class="col-md-5"> 
                                                <input type="text" class="form-control" name="quantite"
                                                @if(isset($alert))
                                                value="{{ $alert->lot->quantite }}" 
                                                @endif 
                                                required>
                                            </div>
                                        </div>
                                    </div>       
                                    <div class="form-group">
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
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="text-right p-t-10 col-md-4">Description</label>
                                            <div class="col-md-5">
                                                <textarea name="description" class="form-control" rows="3">@if(isset($alert)){{ $alert->description }}@endif</textarea>
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
@endsection

