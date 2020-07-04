@extends('main.index')


@section('content')
<div class="content-wrap">
  <div class="main">
     <div class="container-fluid">
       <div class="row main-header">
           <div class="col-lg-8 p-0">
               <div class="page-header">
                   <div class="page-title">
                       <h1>Gestion des roles</h1>
                   </div>
               </div>
           </div>
           <div class="col-lg-4 p-0">
             <div class="page-header">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                        <li><a href="{{ route('home')}}">Accueil</a></li>
                        <li class="active"><a href="{{ route('role.dashbord')}}">Roles</a></li>
                      </ol>
                  </div>
               </div>
           </div>
       </div>
      <div class="main-content">
       <div class="card alert">
         <div class="card-header">
           <div class="col-lg-6">
             <h4>Liste des Roles</h4>
           </div>
           <div class="col-lg-6">
             <div class="text-right">  
                 <a  href="{{ route('role.create')}}">
                  <button type="button" class="btn btn-primary btn-addon m-b-10 m-l-5">
                    <i class="ti-plus"></i>Ajouter un role</button>                 
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
                                title: "Bravo!",
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
                   <table class="table table-responsive">
                     <thead>
                             <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Description</th>
                                <th scope="col">Permission(s)</th>
                                <th scope="col">Action</th>
                             </tr>
                     </thead>
                     <tbody>
                      @foreach($roles as $role)
                      <tr>
                                <th scope="row">{{ $role->id }}</th>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->description }}</td>
                                <td>@foreach ($role->permissions as $permission)
                                      {{ $permission->name }} ;
                                    @endforeach
                                <td>
                                  <a style="text-decoration:none;color:#ffffff;" href="{{ route('role.edit',$role) }}"> 
                                    <button class="btn btn-info btn-sm"> 
                                          <i class="ti-eye" aria-hidden="true"></i> 
                                    </button>
                                  </a> 
                                  <a style="text-decoration:none;color:#ffffff;" href="{{ route('role.edit',$role) }}"> 
                                    <button class="btn btn-warning btn-sm"> 
                                          <i class="ti-pencil-alt" aria-hidden="true"></i> 
                                    </button>
                                  </a> 
                                   <form method="POST" id="delete-form-{{$role->id}}" action="{{ route('role.delete',$role ) }}" style="display:none;">
                                       {{ csrf_field() }}
                                       {{ method_field('delete')}}
                                   </form>
                                   <button class="btn btn-danger btn-sm" onclick='$(document).ready(function(){
                                    swal({
                                                title: "Voulez-vous supprimer ce role ?",
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
                                                    swal("Suppression !!", "Votre role a été supprimer !!", "success");
                                                    document.getElementById("delete-form-{{$role->id}}").submit();
                                                }
                                                else {
                                                    swal("Annulation !!", "Votre role existe encore", "error");
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


 {{ $roles->links()  }}
 
@endsection
