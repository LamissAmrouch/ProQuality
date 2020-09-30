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
                    <!-- /# column -->
                    <div class="col-lg-4 p-0">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="{{ route('home')}}">Accueil</a></li>
                                    <li class="active"><a href="{{ route('alertRP.list')}}">Alertes retours production</a></li>
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
                                    <h4>Liste des alertes retours production</h4>
                                </div>
                                <div class="col-lg-6">
                                    <div class="text-right">  
                                        @role('simple') 
                                            <a href="{{ route('alertRP.create')}}">
                                                <button type="button" class="btn btn-primary btn-addon m-b-10 m-l-5">
                                                    <i class="ti-plus"></i>Ajouter un retour production</button>                 
                                            </a>
                                        @endrole
                                    </div>        
                                </div>
                            </div>
                                <br>
                                <br>
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
                                <div class="card-body">
                                    <table class="table table-responsive table-hover alert-table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Article</th>
                                                <th>Caracteristique</th>
                                                <th>Quantité</th>
                                                <th>Atelier</th>
                                               
                                                <th>Etat</th>
                                                @role('simple')
                                                <th>Action</th>
                                                @endrole
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($alerts as $alert)
                                            <tr @role('gestionnaire') 
                                                    class="tr-alert"  
                                                    data-url="{{ route('anomalie.createFrom',$alert->anomalie_id) }}" 
                                            @endrole>                                                
                                                <th scope="row"> <span class="badge badge-primary">{{ $alert->id }} </span> </th>
                                                <td>{{ $alert->lot->produit->nom }}</td>
                                                <td>{{ $alert->lot->caracteristiquep }}</td>
                                                <td>{{ $alert->lot->quantite }}</td>
                                                <td> {{ $alert->atelier->nom }}</td>
                                              
                                                <td>
                                                    @if ($alert->etat == "nouveau")
                                                        <span class="badge badge-info">
                                                    @elseif ($alert->etat == "en cours")
                                                        <span class="badge badge-warning">
                                                    @else
                                                        <span class="badge badge-primary">
                                                    @endif
                                                        {{ $alert->etat }}</span>
                                                </td>
                                                @role('simple')
                                                <td>
                                                    <a style="text-decoration:none;color:#ffffff;" href="{{ route('alertRP.view',$alert )}}"> 
                                                        <button class="btn btn-info btn-sm"> 
                                                            <i class="ti-eye" aria-hidden="true"></i> 
                                                        </button>
                                                    </a>
                                                    @if($alert->etat == "nouveau")
                                                    <a style="text-decoration:none;color:#ffffff;" href="{{ route('alertRP.edit',$alert )}}"> 
                                                        <button class="btn btn-warning btn-sm"> 
                                                            <i class="ti-pencil-alt" aria-hidden="true"></i> 
                                                        </button>
                                                    </a>  
                                                    <form method="POST" id="delete-form-{{$alert->id}}" action="{{ route('alertRP.delete',$alert) }}" style="display:none;">
                                                        {{ csrf_field() }}
                                                        {{ method_field('delete')}}
                                                    </form>
                                                    <button class="btn btn-danger btn-sm" onclick='$(document).ready(function(){
                                                        swal({
                                                                    title: "Voulez-vous supprimer cette alerte ?",
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
                                                                        swal("Suppression !!", "Votre alerte a été supprimer !!", "success");
                                                                        document.getElementById("delete-form-{{$alert->id}}").submit();
                                                                    }
                                                                    else {
                                                                        swal("Annulation !!", "Votre alerte existe encore", "error");
                                                                    }
                                                                });
                                                                
                                                                });'>
                                                                                                        
                                                        <i class="ti-trash" aria-hidden="true"></i>                                                   
                                                    </button> 
                                                @endif
                                                </td>
                                                @endrole
                                            </tr>                  
                                            @endforeach
                                        </tbody>
                                        </table>

                                        {{ $alerts->links()  }}



</div>
</div>

</div>  

</div>                         
</div>          
</div>    
</div>          
</div> 


 @endsection