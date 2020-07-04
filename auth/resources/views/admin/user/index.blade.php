@extends('main.index')

@section('content')
<div class="content-wrap">
  <div class="main">
     <div class="container-fluid">
        <div class="row main-header">
           <div class="col-lg-8 p-0">
               <div class="page-header">
                   <div class="page-title">
                       <h1>Gestion des utilisateurs</h1>
                   </div>
               </div>
           </div>
           <div class="col-lg-4 p-0">
             <div class="page-header">
                   <div class="page-title">
                      <ol class="breadcrumb text-right">
                        <li><a href="{{ route('home')}}">Accueil</a></li>
                        <li class="active"><a href="{{ route('user.dashbord')}}">Utilisateurs</a></li>                     
                      </ol>
                   </div>
               </div>
           </div>
       </div>
      <div class="main-content">
       <div class="card alert">
         <div class="card-header">
           <div class="col-lg-6">
             <h4>Liste des utilisateurs</h4>
           </div>
           <div class="col-lg-6">
             <div class="text-right">  
                 <a  href="{{ route('user.create')}}">
                  <button type="button" class="btn btn-primary btn-addon m-b-10 m-l-5">
                    <i class="ti-plus"></i>Ajouter un utilisateur</button>
                 </a>
              </div>        
            </div>
    
             
                <br>
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
         <br>
         <br>
         <div class="card-body">
                   <table class="table table-responsive">
                     <thead>
                             <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Prenom</th>
                                <th scope="col">Service</th>
                                <th scope="col">Role(s)</th>
                                <th scope="col">Permissions directes</th>
                                <th scope="col">Action </th>
                             </tr>
                     </thead>
                     <tbody>
                            @foreach($users as $user)
                            <tr>
                                 <th scope="row">{{ $user->id }}</th>
                                 <td>{{ $user->nom }}</td>
                                 <td>{{ $user->prenom }}</td>
                                 <td>{{ $user->service }}</td>
                                 <td>{{ collect($user->getRoleNames())->implode(';') }}</td>
                                 <td> @foreach ($user->permissions as $permission)
                                          {{ $permission->name }} ;
                                      @endforeach
                                </td>
                                 <td>
                                    <button class="btn btn-info btn-sm"> 
                                      <a style="text-decoration:none;color:#ffffff;" href="{{ route('user.edit',$user) }}"> 
                                        <i class="ti-eye" aria-hidden="true"></i> 
                                      </a> 
                                    </button>
                                    <button class="btn btn-warning btn-sm"> 
                                      <a style="text-decoration:none;color:#ffffff;" href="{{ route('user.edit',$user ) }}"> 
                                        <i class="ti-pencil-alt" aria-hidden="true"></i> 
                                      </a> 
                                    </button>
                                    
                                    <form method="POST" id="delete-form-{{$user->id}}" action="{{ route('user.delete',$user ) }}" style="display:none;">
                                       {{ csrf_field() }}
                                       {{ method_field('delete')}}
                                    </form>
                                    <button class="btn btn-danger btn-sm" onclick='$(document).ready(function(){
                                    swal({
                                                title: "Voulez-vous supprimer cet utilisateur ?",
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
                                                    swal("Suppression !!", "Cet utilisateur a été supprimer !!", "success");
                                                    document.getElementById("delete-form-{{$user->id}}").submit();
                                                }
                                                else {
                                                    swal("Annulation !!", "Cet utilisateur existe encore", "error");
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


@endsection