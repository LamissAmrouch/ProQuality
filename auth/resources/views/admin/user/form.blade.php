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
                                <li><a href="{{ route('user.dashbord')}}">Utilisateurs</a></li>
                                <li class="active">                        
                                    @if(!isset($user))
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
                                @if(!isset($user))
                                    {{ __('Ajouter Utilisateur') }}
                                @else
                                    {{ __('Modifier Utilisateur') }}
                                @endif
                            <h4>
                        </div><br><br>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ $action }}" method="POST" >
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="nom" class="text-right p-t-10 col-md-4">{{ __('Nom') }}</label>
                                            <div class="col-md-5">
                                                <input id="nom" type="text" class="form-control" name="nom" 
                                                @if(isset($user))
                                                    value="{{ $user->nom }}" 
                                                @endif
                                                required autofocus>                                        
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="prenom" class="text-right p-t-10 col-md-4">{{ __('Prenom') }}</label>
                                            <div class="col-md-5">
                                                <input id="prenom" type="text" class="form-control" name="prenom" 
                                                @if(isset($user))
                                                    value="{{ $user->prenom }}" 
                                                @endif
                                                required autofocus>                                      
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="email" class="text-right p-t-10 col-md-4">{{ __('Addresse E-mail') }}</label>
                                            <div class="col-md-5">
                                                <input id="email" type="email" class="form-control" name="email"
                                                @if(isset($user))
                                                    value="{{ $user->email }}" 
                                                @endif
                                                required autofocus>                                      
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="numero_tel" class="text-right p-t-10 col-md-4">{{ __('Télephone') }}</label>
                                            <div class="col-md-5">
                                                <input id="numero_tel" type="text" class="form-control" name="numero_tel"
                                                @if(isset($user))
                                                    value="{{ $user->numero_tel }}" 
                                                @endif
                                                required autofocus>                                      
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="service" class="text-right p-t-10 col-md-4">{{ __('Service') }}</label>
                                            <div class="col-md-5">
                                                <select id="service" class="form-control" name="service" required>
                                                    <option value="" disabled>Selectionnez le service</option>
                                                    <option {{{ (isset($user) && $user->service == 'SI') ? "selected=\"selected\"" : "" }}} value="SI">SI</option>
                                                    <option {{{ (isset($user) && $user->service == 'Production') ? "selected=\"selected\"" : "" }}} value="Production">Production</option>
                                                    <option {{{ (isset($user) && $user->service == 'Achat & Stock') ? "selected=\"selected\"" : "" }}} value="Achat & Stock">Achat & Stock</option>
                                                    <option {{{ (isset($user) && $user->service == 'Commerciale') ? "selected=\"selected\"" : "" }}} value="Commerciale">Commerciale</option>
                                                    <option {{{ (isset($user) && $user->service == 'QHSE') ? "selected=\"selected\"" : "" }}} value="QHSE">QHSE</option>
                                                    <option {{{ (isset($user) && $user->service == 'Autre') ? "selected=\"selected\"" : "" }}} value="Autre">Autre</option>
                                                </select>                                    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="roles" class="text-right p-t-10 col-md-4">{{ __('Roles') }}</label>
                                            <div class="col-md-5">
                                                <select id="roles" class="form-control" name="roles[]" required multiple>
                                                    <option value="" disabled selected>Selectionnez les role(s)</option>
                                                    @foreach($roles as $role)
                                                         <option value="{{ $role->name }}"
                                                             @if (isset($user) && $user->hasRole($role->name))
                                                                 selected
                                                             @endif
                                                             > {{ $role->name }}</option>
                                                     @endforeach
                                                </select>                                  
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="permissions" class="text-right p-t-10 col-md-4">{{ __('Permissions Directes') }}</label>
                                            <div class="col-md-5">
                                                <select id="permissions" class="form-control" name="permissions[]" required multiple>
                                                    <option value="" disabled selected>Selectionnez les permission(s)</option>
                                                    @foreach(App\User::all() as $userr)
                                                    @foreach($userr->getDirectPermissions() as $permission)
                                                        <option value="{{ $permission->name }}"
                                                            @if (isset($user) && $user->hasAnyDirectPermission($permission->name))
                                                                selected
                                                            @endif
                                                            > {{ $permission->name }}</option>
                                                    @endforeach
                                                    @endforeach
                                                </select>                                 
                                            </div>
                                        </div>
                                    </div>
                                    @if(!isset($user))
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="password" class="text-right p-t-10 col-md-4">{{ __('Mot de passe') }}</label>
                                                <div class="col-md-5">
                                                    <input id="password" type="password" class="form-control" name="password"
                                                    @if(isset($user))
                                                        value="{{ $user->password }}" 
                                                    @endif
                                                    required autofocus>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
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
