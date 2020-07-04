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
                        <div class="login-form m-t-50">
                            <h3>{{ __('Réinitialiser le mot de passe') }}</h3>
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="form-group">
                                    <label for="email" class="control-label">{{ __('E-mail') }}</label>
                                    <div class="input-group {{ $errors->has('email') ? ' has-error' : ' has-default' }}">
                                        <span class="input-group-addon"><i class="ti-email"></i></span>
                                        <input id="email" type="email" class="form-control @error('email') 
                                        is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback text-center" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="control-label">{{ __('Password') }}</label>
                                    <div class="input-group {{ $errors->has('password') ? ' has-error' : ' has-default' }}">
                                        <span class="input-group-addon"><i class="ti-lock"></i></span>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password-confirm" class="control-label">{{ __('Confirm Password') }}</label>
                                    <div class="input-group {{ $errors->has('password-confirm') ? ' has-error' : ' has-default' }}">
                                        <span class="input-group-addon"><i class="ti-lock"></i></span>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <button class="btn btn-outline btn-default " type="submit">
                                            Réinitialiser
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