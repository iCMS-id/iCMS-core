@extends('layouts.base.web')

@section('title')
Sign In
@endsection

@section('over.content')
<link href="{{ asset('css/animate.min.css') }}" rel="stylesheet">
<div class="login_wrapper">
	<div class="animated bounceInLeft form">
		<section class="login_content">
			<form method="post">
				{!! csrf_field() !!}
				<h1>Login Form</h1>
				<div>
					<input class="form-control" placeholder="Email" required="" type="text" name="email">
				</div>
				<div>
					<input class="form-control" placeholder="Password" required="" type="password" name="password">
				</div>
				<div>
					@if($errors->count() > 0)
						@foreach ($errors->all() as $error)
							<div class="text-center text-danger">{{ $error }}</div>
						@endforeach
					@endif
				</div>
				<div>
					<button class="btn btn-default submit" type="submit">Log in</button>
					<a class="reset_pass" href="#">Lost your password?</a>
				</div>

				<div class="clearfix"></div>

				<div class="separator">
					<p class="change_link">New to site?
						<a href="{{ route('app.register') }}" class="to_register"> Create Account </a>
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