<div class="profile">
	<div class="profile_pic">
		<img src="{{ asset('img/img.jpg') }}" alt="..." class="img-circle profile_img">
	</div>
	<div class="profile_info">
		<span>Welcome,</span>
		<h2>{{ Auth::user()->name }}</h2>
	</div>
</div>