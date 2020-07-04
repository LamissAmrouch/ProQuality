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
                                <li><a href="{{ route('inspection.dashbord')}}">Inspections</a></li>
                                <li class="active">                        
                                    @if(!isset($inspection))
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
                        <div class="card-body">                            
                            <div id="stepper2" class="bs-stepper">
                                <div class="bs-stepper-header">
                                    <div class="step" data-target="#test-nl-1">
                                        <button type="button" class="btn step-trigger" disabled>
                                            <span class="bs-stepper-circle" id="circle-1">1</span>
                                            <span class="bs-stepper-label" id="label-1">Créer</span>
                                        </button>
                                    </div>
                                    <div class="line" id="line-1"></div>
                                    <div class="step" data-target="#test-nl-2">
                                        <button type="button" class="btn step-trigger" disabled>
                                            <span class="bs-stepper-circle" id="circle-2">2</span>
                                            <span class="bs-stepper-label" id="label-2">En cours</span>
                                        </button>
                                    </div>
                                    <div class="line" id="line-2"></div>
                                    <div class="step" data-target="#test-nl-3">
                                        <button type="button" class="btn step-trigger" disabled>
                                            <span class="bs-stepper-circle" id="circle-3">3</span>
                                            <span class="bs-stepper-label" id="label-3">Terminé</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="bs-stepper-content">
                                    <div id="test-nl-1" class="content">
                                        @if(isset($inspection->productImg))
                                            Product Image:
                                            <img alt="Product Image" src="/storage/productimg/{{$inspection->productImg}}"/>
                                        @endif
                                        <form action="{{ route('inspection.create-step1') }}" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            @isset($inspection)<input type="hidden" name="id" class="form-control" value="{{ $inspection->id }}" /> @endisset                                                    
                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="titre" class="text-right p-t-10 col-md-4">{{ __('Titre') }}</label>
                                                    <div class="col-md-5">
                                                        <input id="titre" type="text" class="form-control" name="titre" 
                                                        @if(isset($inspection->titre))
                                                            value="{{ $inspection->titre }}"                                                                     
                                                        @endif
                                                        required autocomplete="titre" autofocus>                                      
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="date" class="text-right p-t-10 col-md-4">{{ __('Date') }}</label>
                                                    <div class="col-md-5">
                                                        <input id="date" type="datetime-local" class="form-control" name="date" 
                                                            @if(isset($inspection))
                                                                @foreach(App\Models\Event::all() as $event)
                                                                    @if($event->inspection_id == $inspection->id)
                                                                    value="{{ date('Y-m-d\TH:i', strtotime($event->start)) }}"
                                                                    @endif
                                                                @endforeach
                                                            @endif 
                                                        required autocomplete="date" autofocus>                                 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="description" class="text-right p-t-10 col-md-4">{{ __('Description') }}</label>
                                                    <div class="col-md-5">
                                                        <textarea name="description" class="form-control" rows="3" required autofocus>  
                                                            @if(isset($inspection->description))
                                                                {{ $inspection->description }} 
                                                            @endif
                                                        </textarea>                                     
                                                    </div>
                                                </div>
                                            </div>     
                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="produit" class="text-right p-t-10 col-md-4">{{ __('Article') }}</label>
                                                    <div class="col-md-5">
                                                        <select id="produit" class="form-control" name="produit"  onchange="showCaractersticProduit()" required>
                                                            <option value="" disabled selected>Selectionnez l'article</option>
                                                            @foreach(App\Models\Produit::where('type', '=' ,'Fini')->get() as $produit)
                                                            <option value="{{ $produit->id }}"
                                                                @if (isset($inspection->lot) && ($inspection->lot->produit->nom == $produit->nom))
                                                                selected
                                                                @endif> {{ $produit->nom }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="caracteristique" class="text-right p-t-10 col-md-4">{{ __('Caractéristique') }}</label>
                                                    <div class="col-md-5">
                                                        <select id="caracteristique" class="form-control" name="caracteristique" required>
                                                            <option value="" disabled selected>Selectionnez la caractéristique</option>
                                                            @if (isset($inspection->lot))
                                                                <option value="{{ $inspection->lot->caracteristiquep }}" selected> {{ $inspection->lot->caracteristiquep }}</option>
                                                            @endif
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="quantite" class="text-right p-t-10 col-md-4">{{ __('Quantité') }}</label>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control" name="quantite"
                                                        @if(isset($inspection->lot))
                                                        value="{{ $inspection->lot->quantite }}" 
                                                        @endif required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="produit" class="text-right p-t-10 col-md-4">{{ __("Image d'article") }}</label>
                                                    <div class="col-md-5">
                                                        <input type="file" {{ (!empty($inspection->productimg)) ? "value='$inspection->productimg'" : ''}} 
                                                        class="form-control-file" name="productimg" id="productimg" aria-describedby="fileHelp">
                                                        <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. 
                                                        Size of image should not be more than 2MB.</small>
                                                    </div>
                                                </div>
                                            </div>     
                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="test" class="text-right p-t-10 col-md-4">{{ __('Test') }}</label>
                                                    <div class="col-md-5">
                                                        <select id="test" class="form-control" name="test" required>
                                                            <option value="" disabled selected>Selectionnez le test</option>
                                                              @foreach(App\Models\Test::all() as $test)
                                                              <option value="{{ $test->id }}"
                                                                @if (isset($inspection) && ($inspection->test_id == $test->id))
                                                                selected
                                                                @endif   
                                                              > {{ $test->nom }}</option>
                                                               @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>                                           
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col text-center">
                                                        <button type="submit" class="btn btn-primary btn-addon sweet-success m-t-10">
                                                            <i class="ti-angle-double-right"></i> {{ __('Suivant') }}
                                                        </button> 
                                                    </div>
                                                </div>
                                            </div>
                                        </form>                              
                                    </div>
                                    <div id="test-nl-2" class="content">
                                        <form id="form2" action="{{route('inspection.create-step2')}}" method="POST">
                                            {{ csrf_field() }}
                                            @isset($inspection) <input type="hidden" name="id" class="form-control" value="{{ $inspection->id }}" /> @endisset
                                            @if(isset($examens) && (!empty($examens)))
                                                <div class="card-header"><h4>Liste des examens du test</h4></div>
                                                <table id="tableID" class="table table-responsive">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">ID</th>
                                                            <th scope="col">Nom</th>
                                                            <th scope="col">Type</th>
                                                            <th scope="col">Min</th>
                                                            <th scope="col">Max</th>
                                                            <th scope="col">Unité</th>                         
                                                            <th scope="col">Check </th>
                                                            <th scope="col">Valeur</th>
                                                            <th scope="col">Etat </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($examens as $examen)
                                                        <tr> 
                                                            <td>{{ $examen->id }} <input type="hidden" name="ExamensIdd[]" class="form-control" value="{{ $examen->id }}">  </td>
                                                            <td>{{ $examen->nom }}</td>
                                                            <td>{{ $examen->type }}</td>
                                                            @if(isset($examen->type) && ($examen->type == "Quantitatif"))
                                                            <td>{{ $examen->min }}</td>
                                                            <td>{{ $examen->max }}</td>
                                                            <td>{{ $examen->unite }}</td>
                                                            @endif
                                                            @if(isset($examen->type) && ($examen->type == "Qualitatif"))
                                                            <td> -- </td>
                                                            <td> -- </td>
                                                            <td> -- </td>   
                                                            @endif
                                                            <td>
                                                                <button type="button" data-whatever="{{ $examen->id }}" data-toggle="modal" class="btn btn-info btn-sm"  
                                                                    @if(isset($examen->type) && ($examen->type == "Quantitatif"))
                                                                    data-target="#modalReponse2"
                                                                    @endif 
                                                                    @if(isset($examen->type) && ($examen->type == "Qualitatif"))
                                                                    data-target="#modalReponse1"
                                                                    @endif 
                                                                    > 
                                                                    <a style="text-decoration:none;color:#ffffff;" > 
                                                                        <i class="ti-check" aria-hidden="true"></i> 
                                                                    </a>  
                                                                </button>     
                                                            </td>   
                                                            <td>
                                                                <input readonly="readonly" style="border: none; border-width: 0; box-shadow: none; background:#fafafa; width:100px; height:30px; padding: 0px; outline:none;" type="text" name="ReponsesValeur[]" 
                                                                @foreach(App\Models\Reponse::where('inspection_id', '=' , $inspection->id )->get() as $reponse)
                                                                    @if( ($reponse->examen_id) == ($examen->id) )
                                                                    value="{{ $reponse->valeur }}"            
                                                                    @endif                                 
                                                                @endforeach>
                                                            </td>
                                                            <td>
                                                                <input readonly="readonly" type="hidden"  name="ReponsesEtat[]"  style="border: none; border-width: 0; box-shadow: none; background:#fafafa; width:100px; height:30px; padding: 0px;"
                                                                    @foreach(App\Models\Reponse::where('inspection_id', '=' , $inspection->id )->get() as $reponse)
                                                                        @if( ($reponse->examen_id) == ($examen->id) )
                                                                            @if( ($reponse->etat) == "Incorrect" )
                                                                                value="{{ $reponse->etat }}"
                                                                                style="border: none; border-width: 0; box-shadow: none; background:#fafafa; "
                                                                            @endif
                                                                            @if( ($reponse->etat) == "Correct" )
                                                                                value="{{ $reponse->etat }}"
                                                                                style="border: none; border-width: 0; box-shadow: none; background:#fafafa;color:#00ED96; "
                                                                            @endif  
                                                                        @endif                                 
                                                                    @endforeach> 
                                                                @foreach(App\Models\Reponse::where('inspection_id', '=' , $inspection->id )->get() as $reponse)
                                                                    @if( ($reponse->examen_id) == ($examen->id) )
                                                                        @if( ($reponse->etat) == "Incorrect" )
                                                                            <span id="incorrect2" class="badge badge-danger" style="display:inline-block">Incorrect</span>
                                                                        @endif
                                                                        @if( ($reponse->etat) == "Correct" )
                                                                            <span id="correct2"  class="badge badge-success" style="display:inline-block">Correct</span>
                                                                        @endif  
                                                                    @endif                                 
                                                                @endforeach 
                                                                <span id="incorrect" class="badge badge-danger" style="display:none">Incorrect</span>
                                                                <span id="correct" class="badge badge-success" style="display:none">Correct</span>
                                                            </td> 
                                                        </tr>                     
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="row">
                                                    <div class="col text-center">
                                                        @isset($inspection)
                                                        <a href="{{ route('inspection.previous',$inspection)}}">
                                                            <button type="button" class="btn btn-warning btn-addon m-b-10 m-l-5">
                                                                <i class="ti-angle-double-left"></i> {{ __('Précedent') }}
                                                            </button>                 
                                                        </a>
                                                        @endisset
                                                        <button onclick="verifyExams()" class="btn btn-primary sweet-success btn-addon m-b-10 m-l-5" type="button" >
                                                            <i class="ti-angle-double-right"></i>{{ __('Suivant') }}
                                                        </button> 
                                                    </div>
                                                </div>
                                            @endif                            
                                        </form> 
                                    </div>
                                    <div id="test-nl-3" class="content">
                                        <form action="{{route('inspection.create-step3')}}" method="POST" >
                                            {{ csrf_field()}}
                                            @isset($inspection)<input type="hidden" name="id" class="form-control" value="{{ $inspection->id }}" /> @endisset
                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="resultats" class="text-right p-t-10 col-md-4">{{ __('Résultat') }}</label>
                                                    <div class="col-md-5">
                                                        <input id="resultats" type="text" class="form-control" name="resultats" 
                                                            style="border: none; border-width: 0; box-shadow: none; background:#fafafa; outline:none;"
                                                            @if(isset($inspection))
                                                                value="{{ $inspection->resultats }}" 
                                                            @endif
                                                            required autocomplete="resultats" autofocus>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="quantiteD" class="text-right p-t-10 col-md-4">{{ __('Quantité Défectueuse') }}</label>
                                                    <div class="col-md-5">
                                                        <input id="quantiteD" type="text" class="form-control" name="quantiteD" 
                                                            @if(isset($inspection))
                                                                value="{{ $inspection->quantiteD }}" 
                                                            @endif
                                                            required autocomplete="quantiteD" autofocus>
                                                    </div>
                                                </div>
                                            </div>

                                            @if(isset($inspection) && $inspection->resultats=="Les réponses des examens ne sont pas toutes correctes")
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-5">
                                                        <div class="checkbox">
                                                            <label id="anomalie">
                                                                <input name="anomalie" type="checkbox">Créer une anomalie ?
                                                            </label>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                            @endisset

                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="commentaire" class="text-right p-t-10 col-md-4">{{ __('Commentaires') }}</label>
                                                    <div class="col-md-5">
                                                        <textarea name="commentaire" class="form-control" rows="3"  autofocus>  
                                                            @if(isset($inspection))
                                                                {{ $inspection->commentaire }}
                                                            @endif
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col text-center">
                                                    @isset($inspection)
                                                    <a href="{{ route('inspection.previous',$inspection)}}">
                                                        <button type="button" class="btn btn-warning btn-addon m-b-10 m-l-5">
                                                            <i class="ti-angle-double-left"></i> {{ __('Précedent') }}
                                                        </button>                 
                                                    </a>
                                                    @endisset
                                                    <button class="btn btn-primary sweet-success btn-addon m-b-10 m-l-5" type="submit">
                                                        <i class="ti-angle-double-right"></i>{{ __('Suivant') }}
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
        </div>
    </div>
</div>
<div class="modal fade" id="modalReponse1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Répondre à l'examen</h4>
      </div>
      <div class="modal-body">
            <div class="basic-form">                                            
              <div class="form-group">
                <input type="hidden" class="form-control" name="ExamId" id="ExamenId1">
              </div> 

             
              <div class="form-group">
              <div class="row">  
                    <label class="text-right p-t-10 col-md-3">La réponse</label> 
                 <div class="col-md-8">                                          
                    <select id="reponseV" class="form-control" name="reponse" onchange="" required>
                          <option value="" disabled selected>Sélectionnez la bonne réponse</option>
                          <option value="Fonctionnel">Fonctionnel</option>
                          <option value="Non Fonctionnel">Non Fonctionnel</option>
                          <option value="Présent">Présent</option>
                          <option value="Non Présent">Non Présent</option>
                    </select>  
              </div>
              </div> 
              </div> 
                
            </div>
       </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
          <button type="button" onclick='Repondre1()' data-dismiss="modal" class="btn btn-primary">Enregistrer</button>
        </div>
    </div>
  </div>
</div>  
<div class="modal fade" id="modalReponse2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Répondre à l'examen</h4>
      </div>
      <div class="modal-body">
            <div class="basic-form">                                      
               
              <div class="form-group">
                <input type="hidden" class="form-control" name="ExamId" id="ExamenId2">
              </div>  
            <div class="form-group">
                <div class="row"> 
                    <label class="text-right p-t-10 col-md-3">La valeur </label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="valeur" id="val" required>
                    </div>  
                </div> 
            </div>      
                
            </div>
       </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
          <button type="button" id="btnRepondre2" onclick='Repondre2()' data-dismiss="modal" class="btn btn-primary">Enregistrer</button>
        </div>
    </div>
  </div>
</div> 
@endsection