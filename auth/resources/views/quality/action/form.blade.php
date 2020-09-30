@extends('main.index')
@section('content')
<div class="content-wrap">
    <div class="main">
       <div class="container-fluid">
            <div class="row main-header">
                <div class="col-lg-8 p-0">
                    <div class="page-header">
                        <div class="page-title">
                            <h1>Gestion des actions</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 p-0">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{ route('home')}}">Accueil</a></li>                    
                                <li><a href="{{ route('action.list')}}">Actions</a></li>
                                <li class="active">                        
                                    @if(!isset($action))
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
            <div class="col-lg-12 p-r-0 p-l-0">
                <div class="card alert">
                    <div class="card-header">
                        <h4>
                            @if(!isset($action))
                                {{ __('Créer Action') }}
                            @else
                                {{ __('Modifier Action') }}
                            @endif
                        </h4>
                    </div>
                    <br>   
                    <br>
                    <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ $actionForm }}" method="POST" >
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="designation" class="text-right p-t-10 col-md-4">{{ __('Designation') }}</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" name="designation" id="designation" 
                                                @if(isset($action))
                                                    value="{{ $action->designation }}" 
                                                @endif required>                                        
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <label for="type" class="text-right p-t-10 col-md-4">{{ __('Type') }}</label>
                                            <div class="col-md-5">
                                                <select id="type" class="form-control" name="type" required >
                                                    <option value="" disabled selected>Selectionnez le type</option>
                                                    <option value="corrective" @if (isset($action) && $action->type=='corrective') selected @endif>Corrective</option>
                                                    <option value="preventive" @if (isset($action) && $action->type=='preventive') selected @endif>Préventive</option>
                                                </select>                                       
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <label for="description" class="text-right p-t-10 col-md-4">{{ __('Description') }}</label>
                                                <div class="col-md-5">
                                                    <textarea name="description" class="form-control" rows="3" required>@if(isset($action)){{ $action->description }}@endif</textarea>                  
                                                </div>                                 
                                        </div>
                                    </div>
                                   
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="resultat" class="text-right p-t-10 col-md-4">{{ __('Résultat') }}</label>
                                            <div class="col-md-5">
                                                <input id="resultat" type="text" class="form-control" name="resultat"
                                                @if(isset($action))
                                                    value="{{ $action->resultat }}" 
                                                @endif
                                                required autocomplete="resultat" autofocus>                                       
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-center">
                                            <button type="submit" class="btn btn-primary btn-addon sweet-success m-t-10">
                                            <i class="ti-save"></i>Enregistrer</button> 
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
@endsection
