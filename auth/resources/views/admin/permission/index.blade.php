@extends('main.index')
@section('content')

<div class="content-wrap">
 <div class="main">
    <div class="container-fluid">
      <div class="row main-header">
          <div class="col-lg-8 p-0">
              <div class="page-header">
                  <div class="page-title">
                      <h1>Gestion des permissions</h1>
                  </div>
              </div>
          </div>
          <div class="col-lg-4 p-0">
            <div class="page-header">
                  <div class="page-title">
                    <ol class="breadcrumb text-right">
                      <li><a href="{{ route('home')}}">Accueil</a></li>
                      <li class="active"><a href="{{ route('permission.dashbord')}}">Permissions</a></li>
                    </ol>
                  </div>
              </div>
          </div>
      </div>
     <div class="main-content">
      <div class="card alert">
        <div class="card-header">
          <div class="col-lg-6">
            <h4>Liste des Permissions</h4>
          </div>
          <div class="col-lg-6">
            <div class="text-right">  
                <a href="{{ route('permission.create')}}">
                  <button type="button" class="btn btn-primary btn-addon m-b-10 m-l-5">
                    <i class="ti-plus"></i>Ajouter une permission</button>                 
                </a>
            </div>        
          </div>
            <br>
            <!-- to Show success message -->
            @if(session('successMsg'))
                <div id="success-msg" style="display: none;"> {{ session('successMsg') }}
                </div>
                <script type="text/javascript">
                    $(document).ready(function(){
                        swal({
                          title: "Réussi !",
                          text: $("#success-msg").text(),
                          type: "success",
                          showConfirmButton: true
                        });                  
                  });
                </script>
             @endif   
        <br>
        <br>
        <div class="card-body">
                  <table class="table table-responsive table-hover">
                    <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Description</th>
                                <th scope="col">Role(s)</th>
                                <th scope="col">Action</th>
                                <th scope="col"></th>
                            </tr>
                    </thead>
                    <tbody>
                              @foreach($permissions as $permission)
                              <tr>
                                <th scope="row">{{ $permission->id }}</th>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->description }}</td>
                                <td>@foreach ($permission->roles as $role)
                                  {{ $role->name }} ;
                                  @endforeach
                                  </td>
                                <td>                                  
                                  <a style="text-decoration:none;color:#ffffff;" href="{{ route('permission.edit',$permission )}}"> 
                                    <button class="btn btn-warning btn-sm"> 
                                          <i class="ti-pencil-alt" aria-hidden="true"></i> 
                                    </button>
                                  </a> 
                                  <form method="POST" id="delete-form-{{$permission->id}}" action="{{ route('permission.delete',$permission ) }}" style="display:none;">
                                      {{ csrf_field() }}
                                      {{ method_field('delete')}}
                                  </form>
                                  <button class="btn btn-danger btn-sm" onclick='$(document).ready(function(){
                                    swal({
                                                        title: "Voulez-vous supprimer cette permission ?",
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
                                                            swal("Suppression !!", "Votre permission a été supprimer !!", "success");
                                                            document.getElementById("delete-form-{{$permission->id}}").submit();
                                                        }
                                                        else {
                                                            swal("Annulation !!", "Votre permission existe encore", "error");
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
</div>    
{{ $permissions->links()  }}

@endsection
