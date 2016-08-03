@extends('layouts.base.web')

@section('title')
Sign In
@endsection

@section('over.content')
<link href="{{ asset('css/animate.min.css') }}" rel="stylesheet">
<div class="login_wrapper">
	<div class="animated bounceInLeft form">
		<section class="login_content">
			<form>
				<h1>Create Account</h1>
				<div>
					<input class="form-control" placeholder="Username" required="" type="text">
				</div>
				<div>
					<input class="form-control" placeholder="Email" required="" type="email">
				</div>
				<div>
					<input class="form-control" placeholder="Password" required="" type="password">
				</div>
				<div>
					<a class="btn btn-default submit" href="index.html">Submit</a>
				</div>

				<div class="clearfix"></div>

				<div class="separator">
					<p class="change_link">Already a member ?
						<a href="{{ route('app.login') }}" class="to_register"> Log in </a>
					</p>

					<div class="clearfix"></div>
					<br>

					<div>
						<h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
						<p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
					</div>
				</div>
			</form>
		</section>
	</div>
</div>
@endsection