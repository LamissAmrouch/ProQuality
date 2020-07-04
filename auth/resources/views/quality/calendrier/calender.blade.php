@extends('main.index')

@section('content')

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row main-header">
                    <div class="col-lg-8 p-0">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Calendrier de planification</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-0">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="{{ route('home')}}">Accueil</a></li>
                                    <li class="active"><a href="{{ route('calendrier.dashbord')}}">Calendrier</a></li> 
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                  <div class="main-content"> 
                        <div class="card alert">
                              <div class="card-header">
                                  <h4>Calendrier </h4>
                              </div> 
                              <div class="card-body">
                                  <div id="response"></div>
                                  <div id="calendar"></div>  
                              </div> 
                          </div>  
                  </div>  

            </div>          
        </div>    
    </div>   
<div class="modal fade" id="modalAddEvent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Planifier évenement</h4>
      </div>
      <div class="modal-body">
        <div class="basic-form">                           
            <form id="AddEventForm">
              <div class="form-group" >
                  <label>Type</label>                                           
                  <select id="type" class="form-control" name="type" required>
                        <option value="1" selected>Inspection</option>
                        <option value="2">Audit</option>
                  </select>
              </div>
              <div class="form-group">
                  <label>Titre</label>
                  <input type="text" class="form-control" name="title" id="title" required>
              </div>
              <div class="checkbox">
                  <label><input type="checkbox" name="rappel" id="rappel" style="color:#00ED96">Me rappelez</label>
              </div>
              <!--  <div class="form-group">
              <label>Heure</label>
              <input type="checkbox" class="form-control" name="heure" id="heure" required>
              </div>  -->
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary" id="enregistrer">Enregistrer</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>  
 @endsection

 
