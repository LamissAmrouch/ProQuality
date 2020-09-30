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
			<div class="row justify-content-center">
				<div class="col-lg-6 col-lg-offset-3">
					<div class="login-content">
                        <div class="login-logo"></div>
                        <div class="login-form m-t-100">
                            <h3>{{ __('Réinitialiser le mot de passe') }}</h3>
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                    <div class="form-group">
                                        <label class="control-label" for="email">{{ __('E-mail') }}</label>
                                        <div class="input-group {{ $errors->has('email') ? ' has-error' : ' has-default' }}">
                                            <span class="input-group-addon"><i class="ti-email"></i></span>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        </div>
                                        @error('email')
                                            <span class="invalid-feedback text-center" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <button class="btn btn-outline btn-default " id="btn-reset" type="submit">
                                                Envoyer le lien de réinitialisation
                                            </button> 
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

