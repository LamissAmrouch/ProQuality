@extends('main.index')

@section('content')
<div class="content-wrap">
   <div class="main">
      <div class="container-fluid">
        <div class="row main-header">
            <div class="col-lg-8 p-0">
                <div class="page-header">
                    <div class="page-title">
                        <h1>Gestion des Articles</h1>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 p-0">
                <div class="page-header">
                    <div class="page-title">
                      <ol class="breadcrumb text-right">
                           <li><a href="{{ route('home')}}">Accueil</a></li>
                           <li><a href="{{ route('produit.list')}}">Articles</a></li>
                           <li class="active">                        
                               @if(!isset($produit))
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
                           @if(!isset($produit))
                               {{ __('Ajouter Article') }}
                           @else
                               {{ __('Modifier Article') }}
                           @endif
                        </h4>
                    </div>
                   <br>   
                   <br>
                   <div class="card-body">
                        <div class="basic-form">
                           <form action="{{ $actionForm }}" method="POST" >
                               {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="row">
                                        <label for="nom" class="text-right p-t-10 col-md-4">{{ __('Nom') }}</label>
                                        <div class="col-md-5">                                           
                                            <input type="text" class="form-control" name="nom" id="nom" 
                                                @if(isset($produit))
                                                    value="{{ $produit->nom }}" 
                                                @endif required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <label for="modele" class="text-right p-t-10 col-md-4">{{ __('Modèle') }}</label>
                                        <div class="col-md-5">                                           
                                           <input type="text" class="form-control" name="modele" id="modele" 
                                                       @if(isset($produit))
                                                           value="{{ $produit->modele }}" 
                                                       @endif required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <label for="type" class="text-right p-t-10 col-md-4">{{ __('Type') }}</label>
                                        <div class="col-md-5">                                           
                                            <select id="type" class="form-control" name="type" required autocomplete="type">
                                                @if(Auth::user()->hasDirectPermission('edit fournisseur'))
                                                    <option selected="selected" value="Matiere Premiere">Matiere Premiere</option>
                                                @else
                                                    @if(Auth::user()->hasDirectPermission('edit client'))
                                                        <option selected="selected" value="Fini">Fini</option>
                                                    @else
                                                        <option value="" disabled>Selectionnez le type</option>
                                                        <option {{{ (isset($produit) && $produit->type == 'Matiere Premiere') ? "selected=\"selected\"" : "" }}} value="Matiere Premiere">Matiere Premiere</option>
                                                        <option {{{ (isset($produit) && $produit->type == 'Semi-fini') ? "selected=\"selected\"" : "" }}} value="Semi-fini">Semi-fini</option>
                                                        <option {{{ (isset($produit) && $produit->type == 'Fini') ? "selected=\"selected\"" : "" }}} value="Fini">Fini</option>
                                                    @endif
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="prix" class="text-right p-t-10 col-md-4">{{ __('Prix') }}</label>
                                        <div class="col-md-5">                                           
                                           <input type="text" class="form-control" name="prix" id="prix" 
                                                       @if(isset($produit))
                                                           value="{{ $produit->prix }}" 
                                                       @endif required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="description" class="text-right p-t-10 col-md-4">{{ __('Description') }}</label>
                                        <div class="col-md-5">                                           
                                            <textarea name="description" class="form-control" rows="3">@if(isset($produit)){{ $produit->description }}@endif</textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                       <div class="col-md-4"></div>
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-info btn-addon m-t-10 m-b-10" data-toggle="modal" id="modal-toggle" 
                                            data-target="#modalAddCaracteristic"><i class="ti-plus"></i>Créer Caractéristique</button>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-info btn-addon m-t-10 m-b-10 m-l-10" 
                                            data-toggle="modal" id="modal-toggle" data-target="#modalAddProcede">
                                                <i class="ti-plus"></i>Créer Procédé</button>
                                        </div>
                                    </div>
                                    </div>
                                    
                                    <h4>Liste des Procédés</h4>  
                                    <table class="table table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Designation</th>
                                                <th>Description</th>
                                                <th>Atelier</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody-procede">  
                                            @if(isset($produit) && (!empty($produit)) ) 
                                                @foreach(App\Models\Procede::where('produit_id', '=' , $produit->id)->get() as $procede)
                                                <tr>
                                                    <td><input type="hidden" name="designationp[]" value="{{$procede->designation}}" designationp>{{ $procede->designation }}</td>
                                                    <td><input type="hidden" name="descriptionp[]" value="{{$procede->description}}" descriptionp>{{ $procede->description }}</td>
                                                    <td><input type="hidden" name="atelierp[]" value="{{$procede->atelier->id}}" atelierp> {{ $procede->atelier->nom}}</td>
                                                    <td><button type="button" id="delete-procede" class="btn btn-danger btn-sm">
                                                        <i class="ti-close" aria-hidden="true"></i></button>
                                                    </td>
                                                </tr>
                                                @endforeach 
                                            @endif
                                        </tbody> 
                                    </table>
                                    <br>
                                    <h4>Liste des Caractéristiques</h4>  
                                    <table class="table table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Designation</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody-caracteristic">  
                                            @if(isset($produit) && (!empty($produit)) ) 
                                                @foreach(App\Models\Caracteristique::where('produit_id', '=' , $produit->id)->get() as $caracteristic)
                                                <tr>
                                                    <td><input type="hidden" name="nomc[]" value="{{$caracteristic->nom}}" nomc>{{ $caracteristic->nom }}</td>
                                                    <td><button type="button" id="delete-caracteristic" class="btn btn-danger btn-sm">
                                                        <i class="ti-close" aria-hidden="true"></i></button>
                                                    </td>
                                                </tr>
                                                @endforeach 
                                            @endif
                                        </tbody> 
                                    </table>
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
<div class="modal fade" id="modalAddProcede" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Ajouter un Procédé</h4>
        </div>
        <div class="modal-body">
          <div class="basic-form">                                      
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label>Designation</label>
                    <input type="text" class="form-control" name="designationProc" id="designationProc" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea id="descriptionProc" class="form-control" rows="3" required></textarea>                  
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Atelier</label>                                           
                        <select id="atelierProc" class="form-control" required>
                            @foreach(App\Models\Atelier::all() as $atelier)
                                <option value="{{ $atelier->id }}">{{ $atelier->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            <button type="button" onclick='addRowProcede()' data-dismiss="modal" class="btn btn-primary">Ajouter</button>
        </div>
      </div>
    </div>
</div>   
<div class="modal fade" id="modalAddCaracteristic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Ajouter une Caractéristique</h4>
        </div>
        <div class="modal-body">
          <div class="basic-form">                                      
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label>Designation</label>
                    <input type="text" class="form-control" name="nomCaracteristic" id="nomCaracteristic" required>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            <button type="button" onclick='addRowCaracteristic()' data-dismiss="modal" class="btn btn-primary">Ajouter</button>
        </div>
      </div>
    </div>
</div>                        
@endsection
