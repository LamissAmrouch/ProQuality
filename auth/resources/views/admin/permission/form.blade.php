 @extends('main.index')

 @section('content')
 <div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row main-header">
                <div class="col-lg-8 p-0">
                    <div class="page-header">
                        <div class="page-title"><h1>Gestion des permissions</h1></div>
                    </div>
                </div>
                <div class="col-lg-4 p-0">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{ route('home')}}">Accueil</a></li>                    
                                <li><a href="{{ route('permission.dashbord')}}">Permissions</a></li>
                                <li class="active">                        
                                    @if(!isset($permission))
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
                                @if(!isset($permission))
                                    {{ __('Ajouter Permission') }}
                                @else
                                    {{ __('Modifier Permission') }}
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
                                                @if(isset($permission))
                                                    value="{{ $permission->name }}" 
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
                                                @if(isset($permission))
                                                    value="{{ $permission->description }}" 
                                                @endif
                                                required autocomplete="description" autofocus>                                       
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
                                                            @if (isset($permission) && $role->hasPermissionTo($permission->name))
                                                                selected
                                                            @endif
                                                            > {{ $role->name }}</option>
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
