<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ProQuality</title>
	<!-- Standard -->
    <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
    <!-- Standard iPad Touch Icon--> 
    <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
    <!-- Standard iPhone Touch Icon--> 
    <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">
	
	<!-- Styles -->
    <link href="{{ asset('public/assets/fontAwesome/css/fontawesome-all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/lib/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/lib/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/lib/nixon.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet">
</head>

<body class="background-login" style="background-image: url({{ asset('public/assets/images/bg/usb.jpg')}} );">
	<div class="login">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-lg-offset-3">
					<div class="login-content">
                        <div class="card">
                            <div class="card-header"><h3>{{ __('Confirmer le Mot de Passe') }}</h3></div>
                            <div class="card-body">
                                {{ __('Veuillez confirmer votre mot de passe avant de continuer.') }}
                                <form method="POST" action="{{ route('password.confirm') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>
                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Confirmer votre mot de passe') }}
                                            </button>
                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('Mot de passe oublié?') }}
                                                </a>
                                            @endif
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
</body>
</html>


