@include('layouts.web.form')

@if (isset($hide_breadcrumb) && $hide_breadcrumb)

@else
@include('layouts.web.breadcrumb')
@endif

@section('over.content')
<div id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				@section('content')
				@show
			</div>
		</div>
		<div class="row">
			@include('layouts.web.leftcontent')
			@include('layouts.web.rightcontent')
		</div>
	</div>
</div>
@show