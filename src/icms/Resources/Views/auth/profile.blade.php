@extends('admin.base')

@section('title')
User Profile
@endsection

@section('page.title')
User Profile
@endsection

@section('panel.title')
User Profile <small>Activity report</small>
@endsection

@section('panel.content')
<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
	<div class="profile_img">
		<div id="crop-avatar">
			<img class="img-responsive avatar-view" src="{{ asset('img/picture.jpg') }}" alt="Avatar" title="Change the avatar">
			<div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
		</div>
	</div>

	<h3>{{ Auth::user()->name }}</h3>

	<ul class="list-unstyled user_data">
		<li><i class="fa fa-map-marker user-profile-icon"></i> San Francisco, California, USA</li>
		<li class="m-top-xs"><i class="fa fa-external-link user-profile-icon"></i> <a href="http://www.kimlabs.com/profile/" target="_blank">www.kimlabs.com</a></li>
	</ul>

	<a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>

	<h4>Skills</h4>
	<ul class="list-unstyled user_data">
		<li>
			<p>Web Applications</p>
			<div class="progress progress_sm">
				<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
			</div>
		</li>
	</ul>
</div>
<div class="col-md-9 col-sm-9 col-xs-12">
	<div class="profile_title">
		<div class="col-md-6">
			<h2>User Activity Report</h2>
		</div>
		<div class="col-md-6"></div>
	</div>

	<div id="graph_bar" style="width:100%; height:180px;"></div>

	<div class="" role="tabpanel" data-example-id="togglable-tabs">
		<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
			<li role="presentation" class="active"><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile</a></li>
			<li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Projects Worked on</a></li>
		</ul>

		<div id="myTabContent" class="tab-content">
			<div role="tabpanel" class="tab-pane fade active in" id="tab_content3" aria-labelledby="home-tab">
				<p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk </p>
			</div>
			<div role="tabpanel" class="tab-pane fade active in" id="tab_content2" aria-labelledby="home-tab"></div>
		</div>
	</div>
</div>
@endsection
