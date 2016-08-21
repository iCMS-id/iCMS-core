@extends('admin.base')

@section('title')
Page Management
@endsection

@section('page.title')
Page Management
@endsection

@section('page.content')
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Page Management</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Settings 1</a></li>
						</ul>
					</li>
					<li><a class="close-link"><i class="fa fa-close"></i></a></li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
<table-container
:header="['Menu', 'Action', 'Order']"
:class-name="['table-bordered']"
key-name="id"
data-src="{{ resolveRoute('admin.page.ajax') }}"
:data-map="[
	{key: 'Menu', value: 'menu'},
	{key: 'Action', value: 'action'},
	{key: 'Order', value: 'order'}
]"
:data-options="{ root_id: {{ $menu->id }} }">
	<div is="menu-control" move-url="{{ resolveRoute('admin.page.move') }}"></div>
</table-container>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Form Menu</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Settings 1</a></li>
						</ul>
					</li>
					<li><a class="close-link"><i class="fa fa-close"></i></a></li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<form class="form-horizontal form-label-left" method="post">
					{!! csrf_field() !!}
					<label>Menu</label>
					<input class="form-control" name="name" required="" type="text">
					<label>Type</label>
					<select class="form-control" id="type-select" name="type">
						<option value="apps">Apps</option>
						<option value="posts">Posts</option>
						<option value="events">Events</option>
						<option value="external" selected="">External</option>
						<option value="empty">Empty</option>
					</select>

					<div id="events">
						<label>Events</label>
						<select class="form-control" style="width: 100%;" id="events-select"></select>
					</div>

					<div id="posts">
						<label>Posts</label>
						<select class="form-control" style="width: 100%;" id="posts-select"></select>
					</div>

					<div id="external">
						<label>Links</label>
						<input class="form-control" name="external" placeholder="http://" type="text">
						<label>Open in New Tab</label><br>
						<input type="checkbox" name="newtab" class="js-switch">
					</div>

					<div id="apps">
						<label>Apps Name</label>
						<select class="form-control" id="apps-select" style="width: 100%;">
							@foreach(Package::getPackages() as $package)
							<option value="{{ $package->name }}">{{ $package->name }}</option>
							@endforeach
						</select>
						<label>Links</label>
						<select class="form-control" id="route-select" style="width: 100%;"></select>
					</div>
					<br>
					<br>
					<button type="submit" class="btn btn-success">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>

<link rel="stylesheet" type="text/css" href="{{ asset('css/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/switchery.min.css') }}">
<script type="text/javascript" src="{{ asset('js/switchery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/select2.full.min.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$('#type-select').select2({allowClear:false, placeholder: "Select Type"}).on('select2:select', function (evt) {
			var data = $(this).val();
			$('#apps').hide();
			$('#events').hide();
			$('#external').hide();
			$('#posts').hide();

			$('#' + data).show();
		});
		$('#apps-select').select2({allowClear:false, placeholder: "Select apps name"}).on('select2:select', function (evt) {
			$('#route-select').val('');
			$('#route-select').trigger('change.select2');
		});
		$('#events-select').select2({
			placeholder: "Select events",
			ajax: {
				dataType: 'json',
				data: function (params) {
					return {search: params.term, page: params.page};
				},
				method: 'post',
				delay: 250,
				cache: true,
				url: "{{ resolveRoute('admin.event.ajax') }}"
			}
		});
		$('#posts-select').select2({
			placeholder: "Select posts",
			ajax: {
				dataType: 'json',
				data: function (params) {
					return {search: params.term, page: params.page};
				},
				method: 'post',
				url: "{{ resolveRoute('admin.post.ajax') }}",
				delay: 250,
				cache: true
			}
		});
		$('#route-select').select2({
			placeholder: "Select route name",
			allowClear: true,
			ajax: {
				dataType: 'json',
				data: function (params) {
					return {search: params.term, page: params.page, apps: $('#apps-select').val()};
				},
				method: 'post',
				delay: 250,
				cache: true,
				url: "{{ resolveRoute('admin.apps.ajax') }}"
			}
		});

		$('#type-select').val('external');
		$('#type-select').trigger('change.select2');
		$('#type-select').trigger('select2:select');
	});
</script>
@endsection
