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
          <div class="col-lg-4 p-0">
               <div class="page-header">
                   <div class="page-title">
                       <ol class="breadcrumb text-right">
                          <li><a href="{{ route('home')}}">Accueil</a></li>                    
                          <li><a href="{{ route('test.list')}}">Tests</a></li>
                          <li class="active">                        
                              @if(!isset($test))
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
                   <div class="card alert">
                                <div class="card-header">
                                    <h4>
                                     @if(!isset($test))
                                       {{ __('Création du test') }}
                                      @else
                                       {{ __('Modification du test') }}
                                     @endif</h4>
                                
                                </div>

                                <br>   
                                <br>
                              <div class="card-body">
                                 <div class="basic-form">
                                      <form  action="{{ $action }}" method="POST"> 
                                        {{ csrf_field()}} 
                                        <div class="form-group">
                                          <div class="row">
                                            <label for="nom" class="text-right p-t-10 col-md-4">{{ __('Nom') }}</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" name="nom"
                                                @if(isset($test))
                                                  value="{{ $test->nom }}" 
                                                @endif   
                                                required>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <div class="row">
                                            <label for="type" class="text-right p-t-10 col-md-4">{{ __('Type') }}</label>
                                            <div class="col-md-5">
                                              <input type="text" class="form-control" name="type"
                                                @if(isset($test))
                                                value="{{ $test->type }}" 
                                                @endif 
                                              required>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <div class="row">
                                            <label for="description" class="text-right p-t-10 col-md-4">{{ __('Description') }}</label>
                                            <div class="col-md-5">
                                              <textarea name="description" class="form-control" rows="3" required>  
                                                @if(isset($test))
                                                {{ $test->description }}
                                                @endif
                                              </textarea>
                                              <div class="text-right">   
                                                <button type="button" class="btn btn-info btn-addon m-t-10 m-b-10 m-l-5" 
                                                  data-toggle="modal" id="modal-toggle" data-target="#modalAddExam">
                                                    <i class="ti-plus"></i>Ajouter des examens</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>   
                                <h4>Liste des examens</h4>  
                                <table class="table table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Nom</th>
                                                <th>Type</th>
                                                <th>Valeur Min</th>
                                                <th>Valeur Max</th>
                                                <th>Unité</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody-exam">  
                                        @if(isset($test) && (!empty($test)) ) 
                                          @foreach(App\Models\Examen::where('test_id', '=' , $test->id)->get() as $examen)
                                          <tr>
                                                <td><input type="hidden" name="nomE[]" value="{{$examen->nom}}">{{ $examen->nom }}</td>
                                                <td><input type="hidden" name="typeE[]" value="{{$examen->type}}">{{ $examen->type }}</td>
                                                @if(isset($examen->type) && ($examen->type == "Quantitatif"))
                                                            <td><input type="hidden" name="min[]" value="{{$examen->min}}">{{ $examen->min }}</td>
                                                            <td><input type="hidden" name="max[]" value="{{$examen->max}}">{{ $examen->max }}</td>
                                                            <td> <input type="hidden" name="unite[]" value="{{$examen->unite}}">{{ $examen->unite }}</td>
                                                @endif
                                                @if(isset($examen->type) && ($examen->type == "Qualitatif"))
                                                            <td> -- </td>
                                                            <td> -- </td>
                                                            <td> -- </td>   
                                                @endif
                                                
                                                <td><button type="button" id="delete-exam" class="btn btn-danger btn-sm">
                                                    <i class="ti-close" aria-hidden="true"></i></button>
                                                </td>
                                          </tr>
                                          @endforeach 
                                          @endif
                                        </tbody> 
                                </table>
                                <br><br>
                                  <div class="row">
                                    <div class="col text-center">
                                        <button class="btn btn-primary sweet-success btn-addon m-b-10 m-l-5" type="submit">
                                            <i class="ti-save"></i>{{ __('Enregistrer') }}
                                        </button> 
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

<div class="modal fade" id="modalAddExam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Ajouter un examen</h4>
      </div>
      <div class="modal-body">
        <div class="basic-form">                                      
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label>Nom</label>
                <input type="text" class="form-control" name="nomE" id="nomE" required>
              </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group" >
                    <label>Type</label>                                           
                    <select id="typeE" class="form-control" name="typeE" onchange="showTypeExam()" required>
                          <option value="" disabled selected>Sélectionnez le type</option>
                          <option value="Quantitatif">Quantitatif</option>
                          <option value="Qualitatif">Qualitatif</option>
                    </select>
                </div>
            </div>
          </div>
                                                
         <div class="row" id="row1" style="display:none;">
              <div class="col-lg-4">
                  <div class="form-group">
                    <label>Valeur min</label>
                    <input type="text" class="form-control" name="min" id="min">
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="form-group">
                    <label>Valeur max</label>
                    <input type="text" class="form-control" name="max" id="max">
                  </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                    <label>Unité</label>
                    <input type="text" class="form-control" name="unite" id="unite">
                </div>
              </div>
            </div>
             <!-- <div class="row" id="row2" style="display:none;">
            
              <div class="col-lg-6">
                  <div class="form-group">
                    <label>Réponse 1</label>
                    <input type="text" class="form-control" name="reponse" id="reponse">
                  </div>
              </div>

              <div class="col-lg-6">
                  <div class="form-group">
                    <label>Réponse 2</label>
                    <input type="text" class="form-control" name="reponseTwo" id="reponseTwo">
                  </div>
              </div>
                
            </div>   -->
        </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
          <button type="button" onclick='addRowExam()' data-dismiss="modal" class="btn btn-primary">Ajouter</button>
        </div>
    </div>
  </div>
</div>  
 @endsection

