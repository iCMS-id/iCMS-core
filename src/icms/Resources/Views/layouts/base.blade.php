<!DOCTYPE html>
<html>
<head>
	<title>@yield('title','Welcome to iCMS')</title>
	
	{!! Theme::importsTheme() !!}
</head>
<body>
	@yield('content')
</body>
</html>