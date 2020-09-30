@extends('main.index')
@section('content')

<div class="content-wrap">
  <div class="main">
    <div class="container-fluid">
        <div class="row main-header">
            <div class="col-lg-8 p-0">
                <div class="page-header">
                    <div class="page-title">
                        <h1>Gestion des inspections</h1>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 p-0">
              <div class="page-header">
                    <div class="page-title">
                      <ol class="breadcrumb text-right">
                        <li><a href="{{ route('home')}}">Accueil</a></li>
                        <li class="active"><a href="{{ route('inspection.dashbord')}}">Inspection</a></li> 
                      </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-content">
          <div class="card alert">
            <div class="card-header">
              <div class="col-lg-6">
                <h4>Liste des inspections</h4>
              </div>
              <div class="col-lg-6">
                <div class="text-right">  
                    <a class="btn btn-warning btn-addon m-b-10 m-l-5" href="{{ route('inspection.export') }}">
                        <i class="ti-upload"></i>Exporter journal
                    </a>
                    <a href="{{ route('inspection.create')}}">
                      <button type="button" class="btn btn-primary btn-addon m-b-10 m-l-5">
                        <i class="ti-plus"></i>Ajouter une inspection</button>                 
                    </a>
                  </div>        
                </div>
              </div>
                    <br>
                    <br>
                    <br>
                    <div class="card-body">
                      <table class="table table-responsive">
                        <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Titre</th>
                                    <th scope="col">Produit</th>
                                    <th scope="col">Etat</th>
                                    <th scope="col">Action </th>
                                </tr>
                        </thead>
                        <tbody>
                                  @foreach($inspections as $inspection)
                                  <tr>
                                    <th scope="row"> <span class="badge badge-primary">{{ $inspection->id }} </span></th>
                                    <td>{{ $inspection->titre }}</td>
                                    @if(isset($inspection->lot->produit))
                                      <td>{{ $inspection->lot->produit->nom }}</td>
                                    @else
                                      <td>-</td>
                                    @endif
                                    <td>
                                        @if ($inspection->etat == "nouveau")
                                            <span class="badge badge-info">
                                        @elseif ($inspection->etat == "en cours")
                                            <span class="badge badge-warning">
                                        @else
                                            <span class="badge badge-primary">
                                        @endif
                                        {{ $inspection->etat }}</span>
                                    </td>  
                                    <td>
                                      <a style="text-decoration:none;color:#ffffff;" href="{{ route('inspection.view',$inspection) }}"> 
                                        <button class="btn btn-info btn-sm"> 
                                            <i class="ti-eye" aria-hidden="true"></i> 
                                        </button>
                                      </a>
                                      <a style="text-decoration:none;color:#ffffff" href=" {{ route('inspection.edit',$inspection) }}"> 
                                        <button class="btn btn-warning btn-sm"> 
                                            <i class="ti-pencil-alt" aria-hidden="true"></i> 
                                        </button>
                                      </a>  
                                      <form method="POST" id="delete-form-{{$inspection->id}}"  action="{{ route('inspection.delete',$inspection) }}" style="display:none;">
                                          {{ csrf_field() }}
                                          {{ method_field('delete')}}
                                      </form>
                                      <button class="btn btn-danger btn-sm" onclick='$(document).ready(function(){
                                      swal({
                                                            title: "Voulez-vous supprimer cette inspection ?",
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
                                                                swal("Suppression !!", "Votre inspection a été supprimer !!", "success");
                                                                document.getElementById("delete-form-{{$inspection->id}}").submit();
                                                            }
                                                            else {
                                                                swal("Annulation !!", "Votre inspection existe encore", "error");
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
        <!-- main content -->
        </div> 
      <!-- container-fluid -->   


{{ $inspections->links()  }}

@endsection
