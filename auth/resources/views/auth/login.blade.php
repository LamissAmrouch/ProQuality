<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ProQuality</title>
	
	<!-- ================= Favicon ================== -->
    <!-- Standard -->
 
    <link rel="shortcut icon" href="{{ asset('public/logo/ProQuality_small.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('public/logo/ProQuality_small.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('public/logo/ProQuality_small.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('public/logo/ProQuality_small.png') }}"> 
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('public/logo/ProQuality_small.png') }}">

	
	<!-- Styles -->
    <link href="{{ asset('public/assets/fontAwesome/css/fontawesome-all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/lib/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/lib/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/lib/nixon.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet">
</head>

<body class="background-login m-t-100" style="background-image: url({{ asset('public/assets/images/bg/usb.jpg')}} );">
	<div class="login">
		<div class="container">
			<div class="row">
				<div class="col-8 col-md-6 col-md-offset-3">
					<div class="login-content">
						<div class="login-logo">
						</div>
						<div class="login-form">
							<h2>Bienvenu dans ProQuality</h2>
							<h3>{{ __('Connexion') }}</h3>
							<form method="POST" action="{{ route('login') }}">
								@csrf
								<div class="form-group has-feedback">
									<label class="control-label" for="email">{{ __('Email') }}</label>
									<div class="input-group {{ $errors->has('email') ? ' has-error' : ' has-default' }}">
										<span class="input-group-addon"><i class="ti-user"></i></span>
										<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
										name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
									</div>
									@error('email')
										<span class="ti-close form-control-feedback invalid-feedback"></span>
										<span class="invalid-feedback text-center" role="alert">
											<strong>{{ $message  }}</strong>
										</span>
									@enderror
								</div>
								<div class="form-group has-feedback">
									<label class="control-label" for="password">{{ __('Mot de passe') }}</label>
									<div class="input-group {{ $errors->has('password') ? ' has-error' : ' has-default' }}">
										<span class="input-group-addon"><i class="ti-lock"></i></span>
										<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
										name="password" required autocomplete="current-password">
									</div>
									@error('password')
										<span class="ti-close form-control-feedback invalid-feedback"></span>
										<span class="invalid-feedback text-center" role="alert">
											<strong>{{ $message  }}</strong>
										</span>
									@enderror
								</div>
								<div class="checkbox">
								
								
									<label class="pull-right">
										@if (Route::has('password.request'))
											<a href="{{ route('password.request') }}">
												{{ __('Mot de passe oublié ?') }}
											</a>
										@endif
									</label>
								</div>	
								<br> <br>
								
		
								<div class="center" style="margin-left:35%;margin-right:35%;">
									<button type="submit" class="btn btn-default">Se connecter</button>
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