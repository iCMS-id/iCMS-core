<li class="">
	<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
		<img src="{{ asset('img/img.jpg') }}" alt="">{{ Auth::user()->name }}
		<span class=" fa fa-angle-down"></span>
	</a>
	<ul class="dropdown-menu dropdown-usermenu pull-right">
		<li><a href="{{ resolveRoute('admin.home') }}">Control Panel</a></li>
		<li><a href="{{ resolveRoute('app.profile') }}"> Profile</a></li>
		<li><a href="javascript:;">
			<span class="badge bg-red pull-right">50%</span>
			<span>Settings</span>
		</a></li>
		<li><a href="javascript:;">Help</a></li>
		<li><a href="{{ resolveRoute('app.logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
	</ul>
</li>