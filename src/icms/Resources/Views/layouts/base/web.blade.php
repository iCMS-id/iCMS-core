<!DOCTYPE html>
<html>
	<head>
		<title>@yield('title','Welcome to iCMS')</title>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		{!! Theme::importsTheme() !!}
		<link rel="stylesheet" type="text/css" href="{{ asset('css/roboto.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/owl.carousel.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/owl.theme.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/animate.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/style.default.css') }}">
	</head>
	<body class="webpage">
		<div id="all">
			@include('layouts.web.header')
			@include('layouts.web.content')
			@include('layouts.web.footer')
		</div>

		<script type="text/javascript" src="{{ asset('js/waypoints.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/jquery.counterup.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/owl.carousel.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/front.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/vue.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
		<script type="text/javascript">
			$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
			$(document).ready(function () {
				var app = new Vue({ el: 'body' });
			});
		</script>
	</body>
</html>