@extends('main.index')

@section('content')
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row main-header">
                <div class="col-lg-8 p-0">
                    <div class="page-header">
                        <div class="page-title">
                            <h1>Gestion des clients</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 p-0">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{ route('home')}}">Accueil</a></li>
                                <li><a href="{{ route('client.list')}}">Clients</a></li>
                                <li class="active">                        
                                    @if(!isset($client))
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
                                @if(!isset($client))
                                    {{ __('Ajouter client') }}
                                @else
                                    {{ __('Modifier client') }}
                                @endif
                            </h4>
                        </div><br><br>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ $actionForm }}" method="POST" >
                                    {{ csrf_field() }}
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="nom" class="text-right p-t-10 col-md-4">{{ __('Nom') }}</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" name="nom" id="nom" 
                                                    @if(isset($client))
                                                        value="{{ $client->nom }}" 
                                                    @endif required>                                           
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="adresse" class="text-right p-t-10 col-md-4">{{ __('Adresse') }}</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" name="adresse" id="adresse" 
                                                    @if(isset($client))
                                                        value="{{ $client->adresse }}" 
                                                    @endif required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="note" class="text-right p-t-10 col-md-4">{{ __('Note') }}</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" name="note" id="note" 
                                                    @if(isset($client))
                                                        value="{{ $client->note }}" 
                                                    @endif required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="description" class="text-right p-t-10 col-md-4">{{ __('Description') }}</label>
                                                <div class="col-md-5">
                                                    <textarea name="description" class="form-control" rows="3" >
                                                        @if(isset($client))
                                                            {{ $client->description }}
                                                        @endif  
                                                    </textarea>
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
