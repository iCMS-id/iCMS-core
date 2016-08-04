<ul class="nav navbar-nav navbar-right">
	@if(Auth::check())
	@include('layouts.top.profile')
	@else
	<li><a href="{{ route('app.login') }}">Sign In</a></li>
	<li><a href="{{ route('app.register') }}">Register</a></li>
	@endif
</ul>