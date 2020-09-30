@extends('main.index')

@section('content')
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row main-header">
                    <div class="col-lg-8 p-0">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Gestion des tests</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-0">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="{{ route('home')}}">Accueil</a></li>
                                    <li class="active"><a href="{{ route('test.list')}}">Tests</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /# row -->
                <div class="main-content">
                            <div class="card alert">
                                <div class="card-header">
                                    <div class="col-lg-6">
                                        <h4>Liste des tests</h4>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="text-right">  
                                            <a href="{{ route('test.create')}}">
                                                <button type="button" class="btn btn-primary btn-addon m-b-10 m-l-5">
                                                <i class="ti-plus"></i>Ajouter un test</button>                 
                                            </a>
                                        </div>        
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
                                <div class="card-body">
                                    <table class="table table-responsive">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nom</th>
                                                <th>Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($tests as $test)
                                            <tr>
                                                <th scope="row"> <span class="badge badge-primary">{{ $test->id }} </span> </th>
                                                <td>{{ $test->nom }}</td>
                                                <td>{{ $test->type }}</td>
                                                
                                                <td>
                                                
                                                
                                                <a style="text-decoration:none;color:#ffffff" href="{{ route('test.edit',$test )}}"> 
                                                    <button class="btn btn-warning btn-sm"> 
                                                        <i class="ti-pencil-alt" aria-hidden="true"></i> 
                                                    </button>
                                                </a>  
                                                <form method="POST" id="delete-form-{{$test->id}}" action="{{ route('test.delete',$test) }}" style="display:none;">
                                                    {{ csrf_field() }}
                                                    {{ method_field('delete')}}
                                                </form>
                                                <button class="btn btn-danger btn-sm" onclick='$(document).ready(function(){
                                                    swal({
                                                                title: "Voulez-vous supprimer ce test ?",
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
                                                                    swal("Suppression !!", "Votre test a été supprimer !!", "success");
                                                                    document.getElementById("delete-form-{{$test->id}}").submit();
                                                                }
                                                                else {
                                                                    swal("Annulation !!", "Votre test existe encore", "error");
                                                                }
                                                            });
                                                            
                                                            });'>
                                                                                                    
                                                    <i class="ti-trash" aria-hidden="true"></i>                                                  
                                                </button> 


                                            </td> </tr>                  
@endforeach
</tbody>
</table>

{{ $tests->links()  }}

</div>
</div>

</div>  

</div>                         
</div>          
</div>    
</div>          
</div> 


 @endsection