<!DOCTYPE html>
<html>
	<head>
		<title>@yield('title','Welcome to iCMS')</title>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		{!! Theme::importsTheme() !!}
	</head>
	<body class="nav-md">
		<div class="container body">
			<div class="main_container">
				<div class="col-md-3 left_col">
					<div class="left_col scroll-view">
						<div class="navbar nav_title" style="border: 0;">
							<a href="#" class="site_title"><i class="fa fa-paw"></i> <span>iCMS</span></a>
						</div>

						<div class="clearfix"></div>
						@include('layouts.profile')
						@include('layouts.sidebar')
						@include('layouts.sidebarfooter')
					</div>
				</div>

				@include('layouts.top')
				@include('layouts.page')
				@include('layouts.footer')
			</div>
		</div>

		<link rel="stylesheet" type="text/css" href="{{ asset('css/custom.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
		<script type="text/javascript" src="{{ asset('js/icheck.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/custom.min.js') }}"></script>
	</body>
</html>