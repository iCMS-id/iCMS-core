<div class="row tile_count">
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		<span class="count_top"><i class="fa fa-user"></i> Total Users</span>
		<div class="count">2500</div>
		<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>4% </i> From last Week</span>
	</div>
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		<span class="count_top"><i class="fa fa-user"></i> Total Users</span>
		<div class="count green">2500</div>
		<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>4% </i> From last Week</span>
	</div>
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		<span class="count_top"><i class="fa fa-user"></i> Total Users</span>
		<div class="count">2500</div>
		<span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
	</div>
</div>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		@include('layouts.widget.network')
	</div>
</div>

<br>
<div class="row">
	<div class="col-md-4 col-sm-4 col-xs-12">
		@include('layouts.widget.app')
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		@include('layouts.widget.device')
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		@include('layouts.widget.quick')
	</div>
</div>

<div class="row">
	<div class="col-md-4 col-sm-4 col-xs-12">
		@include('layouts.widget.recent')
	</div>
	<div class="col-md-8 col-sm-8 col-xs-12">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				@include('layouts.widget.geostat')
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				@include('layouts.widget.todo')
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				@include('layouts.widget.weather')
			</div>
		</div>
	</div>
</div>