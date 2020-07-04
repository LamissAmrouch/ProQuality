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
                                    <li><a href="{{ route('role.dashbord')}}">Roles</a></li>
                                    <li class="active">                        
                                        @if(!isset($role))
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
                                @if(!isset($role))
                                    {{ __('Ajouter Role') }}
                                @else
                                    {{ __('Modifier Role') }}
                                @endif
                            </h4>
                        </div><br><br>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ $action }}" method="POST" >
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="name" class="text-right p-t-10 col-md-4">{{ __('Nom') }}</label>
                                            <div class="col-md-5">
                                                <input id="name" type="text" class="form-control" name="name" 
                                                @if(isset($role))
                                                    value="{{ $role->name }}" 
                                                @endif
                                                required autocomplete="name" autofocus>                                        
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="description" class="text-right p-t-10 col-md-4">{{ __('Description') }}</label>
                                            <div class="col-md-5">
                                                <input id="description" type="text" class="form-control" name="description"
                                                @if(isset($role))
                                                    value="{{ $role->description }}" 
                                                @endif
                                                required autocomplete="description" autofocus>                                       
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="permissions" class="text-right p-t-10 col-md-4">{{ __('Permissions') }}</label>
                                            <div class="col-md-5">
                                                <select id="permissions" class="form-control" name="permissions[]" required multiple>
                                                    <option value="" disabled selected>Selectionnez les permission(s)</option>
                                                    @foreach($permissions as $permission)
                                                            <option value="{{ $permission->name }}"
                                                                @if (isset($role) && $role->hasPermissionTo($permission->name))
                                                                    selected
                                                                @endif
                                                                > {{ $permission->name }}</option>
                                                        @endforeach
                                                </select>                                       
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-center">
                                            <button type="submit" class="btn btn-primary btn-addon sweet-success m-t-10">
                                            <i class="ti-save"></i>Enregistrer</button> 
                                        </div>
                                    </div>  
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