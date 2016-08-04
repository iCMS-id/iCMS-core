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
		@include('layouts.menu.web')
		
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