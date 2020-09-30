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
                    <!-- /# column -->
                    <div class="col-lg-4 p-0">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="{{ route('home')}}">Accueil</a></li>
                                    <li class="active"><a href="{{ route('produit.list')}}">Articles</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <div class="main-content">
                    <div class="card alert">
                                <div class="card-header">
                                    <div class="col-lg-6">
                                      <h4>Liste des Articles</h4>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="text-right">  
                                            <button type="button" class="btn btn-info btn-addon m-b-10 m-l-5" 
                                                data-toggle="modal" id="modal-toggle" data-target="#modalImporter">
                                                <i class="ti-download"></i>Importer</button>
                                            <a class="btn btn-warning btn-addon m-b-10 m-l-5" href="{{ route('produit.export') }}">
                                                <i class="ti-upload"></i>Exporter
                                            </a>
                                            <a href="{{ route('produit.create')}}">
                                                <button type="button" class="btn btn-primary btn-addon m-b-10 m-l-5">
                                                    <i class="ti-plus"></i>Ajouter un article</button>                 
                                            </a>
                                        </div>        
                                    </div>
                                <br><br>
                                <!-- to Show sweet alert success message -->
                                @if(session('successMsg'))
                                    <div id="success-msg" style="display: none;"> {{ session('successMsg') }}
                                    </div>
                                    <script type="text/javascript">
                                        $(document).ready(function(){
                                            swal({
                                            title: "Réussi",
                                            text: $("#success-msg").text(),
                                            type: "success",
                                            showConfirmButton: true
                                            });                  
                                    });
                                    </script>
                                @endif
                                <br>
                            <div class="card-body">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nom</th>
                                            <th>Type</th>
                                            <th>Modèle</th>
                                            <th>Action(s)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if(Auth::user()->hasDirectPermission('edit fournisseur'))
                                        @php($produits = App\Models\Produit::where('type','=','Matiere Premiere')->get())
                                    @else
                                        @if(Auth::user()->hasDirectPermission('edit client'))
                                            @php($produits = App\Models\Produit::where('type','=','Fini')->get())
                                        @else
                                            @php($produits = App\Models\Produit::all())
                                        @endif
                                    @endif
                                    @foreach($produits as $produit)
                                        <tr>
                                            <th scope="row"> <span class="badge badge-primary">{{ $produit->id }} </span> </th>
                                            <td>{{ $produit->nom }}</td>
                                            <td>{{ $produit->type }}</td>
                                            <td>{{ $produit->modele }}</td>
                                            
                                            <td>
                                                <a style="text-decoration:none;color:#ffffff;" href="{{ route('produit.edit',$produit )}}"> 
                                                    <button class="btn btn-warning btn-sm"> 
                                                            <i class="ti-pencil-alt" aria-hidden="true"></i> 
                                                    </button>
                                                </a>  
                                                <form method="POST" id="delete-form-{{$produit->id}}" action="{{ route('produit.delete',$produit) }}" style="display:none;">
                                                    {{ csrf_field() }}
                                                    {{ method_field('delete')}}
                                                </form>

                                                <button class="btn btn-danger btn-sm" onclick='$(document).ready(function(){
                                                swal({
                                                            title: "Voulez-vous supprimer cette article ?",
                                                            text: "",
                                                            type: "warning",
                                                            showCancelButton: true,
                                                            confirmButtonColor: "#DD6B55",
                                                            confirmButtonText: "Oui, supprimer",
                                                            cancelButtonText: "Non, annuler",
                                                            closeOnConfirm: false,
                                                            closeOnCancel: false
                                                        },
                                                        function(isConfirm){
                                                            if (isConfirm) {
                                                                swal("Suppression !!", "Votre article a été supprimer !!", "success");
                                                                document.getElementById("delete-form-{{$produit->id}}").submit();
                                                            }
                                                            else {
                                                                swal("Annulation !!", "Votre article existe encore", "error");
                                                            }
                                                        });
                                                        
                                                        });'>
                                                <i class="ti-trash" aria-hidden="true"></i>                                                  
                                                </button> 
                                            </td> 
                                        </tr>                  
                                    @endforeach
                                </tbody>
                               </table>
                            </div>
                        </div>
                    </div>  
                </div>                         
            </div>          
        </div>    
    </div>


    <div class="modal fade" id="modalImporter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Importer des articles</h4>
                </div>
                <div class="modal-body">
                    <div class="basic-form">
                        <form action="{{ route('produit.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" class="form-control">
                            <br>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-info btn-addon m-b-10 m-l-5">
                                    <i class="ti-download"></i>Importer
                                </button>
                            </div>
                        </form>                                      
                    </div>
                </div>
            </div>
        </div>  
    </div>  
 @endsection