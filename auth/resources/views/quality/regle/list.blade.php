@extends('main.index')

@section('content')
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row main-header">
                    <div class="col-lg-8 p-0">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Gestion des règles qualité</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-0">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="{{ route('home')}}">Accueil</a></li>
                                    <li class="active"><a href="{{ route('regle.list')}}">Règles de qualité</a></li>
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
                                      <h4>Liste des règles qualité</h4>
                                    </div>
                                    <div class="col-lg-6">
                                      <div class="text-right">  
                                          <a href="{{ route('regle.create')}}">
                                              <button type="button" class="btn btn-primary btn-addon m-b-10 m-l-5">
                                                <i class="ti-plus"></i>Ajouter une regle</button>               
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
                                            title: "Bravo!",
                                            text: $("#success-msg").text(),
                                            type: "success",
                                            showConfirmButton: true
                                            });                  
                                    });
                                    </script>
                                @endif
                                <div class="card-body">
                                    <table class="table table-responsive">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Titre</th>
                                                <th>Contenu</th>
                                                <th>Produit</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($regles as $regle)
                                            <tr>
                                                <th scope="row"> <span class="badge badge-primary">{{ $regle->id }} </span> </th>
                                                <td>{{ $regle->titre }}</td>
                                                <td>{{ $regle->contenu }}</td>
                                                <td>{{ $regle->produit->nom }}</td>
                                                <td>
                                                    <a style="text-decoration:none;color:#ffffff;" href="{{ route('regle.edit',$regle )}}"> 
                                                        <button class="btn btn-info btn-sm"> 
                                                            <i class="ti-eye" aria-hidden="true"></i> 
                                                        </button>
                                                    </a>
                                                    <a style="text-decoration:none;color:#ffffff;" href="{{ route('regle.edit',$regle )}}"> 
                                                        <button class="btn btn-warning btn-sm"> 
                                                            <i class="ti-pencil-alt" aria-hidden="true"></i> 
                                                        </button>
                                                    </a>  
                                                    <form method="POST" id="delete-form-{{$regle->id}}" action="{{ route('regle.delete',$regle) }}" style="display:none;">
                                                        {{ csrf_field() }}
                                                        {{ method_field('delete')}}
                                                    </form>
                                                <button class="btn btn-danger btn-sm" onclick='$(document).ready(function(){
                                                swal({
                                                            title: "Voulez-vous supprimer cette règle qualité ?",
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
                                                                swal("Suppression !!", "Votre règle qualité a été supprimer !!", "success");
                                                                document.getElementById("delete-form-{{$regle->id}}").submit();
                                                            }
                                                            else {
                                                                swal("Annulation !!", "Votre règle qualité existe encore", "error");
                                                            }
                                                        });
                                                        
                                                        });'>
                                                                                                
                                                <i class="ti-trash" aria-hidden="true"></i>                                                  
                                                </button> 

</td> </tr>                  
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
</div> 


 @endsection