<!DOCTYPE html>
<html>
	<head>
		<title>@yield('title','Welcome to iCMS')</title>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		{!! Theme::importsTheme() !!}
	</head>
	<body class="webpage">
		<div class="top_nav">
			<div class="nav_menu">
				<nav class="" role="navigation">
					<div class="container menu">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="#">Sistem Sekolah</a>
						</div>

						<ul class="nav navbar-nav">
							<li class=""><a href="#">Home</a></li>
							<li class=""><a href="#">Contact Us</a></li>
						</ul>

						<ul class="nav navbar-nav navbar-right">
							<li><a href="{{ route('app.login') }}">Sign In</a></li>
							<li><a href="{{ route('app.register') }}">Register</a></li>
						</ul>
					</div>
				</nav>
			</div>
		</div>
		
		<div class="clearfix"></div>

		@section('over.content')
		<div class="page container">
			@yield('content')
		</div>
		@show

		<link rel="stylesheet" type="text/css" href="{{ asset('css/custom.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
	</body>
</html>