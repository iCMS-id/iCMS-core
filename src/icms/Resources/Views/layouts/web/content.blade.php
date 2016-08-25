@include('layouts.web.form')

@if (isset($hide_breadcrumb) && $hide_breadcrumb)

@else
<!-- @include('layouts.web.breadcrumb') -->
@endif

@section('over.content')
<div id="content" style="min-height: 600px;padding-bottom:15px;">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				@section('content')
				@show
			</div>
		</div>
	</div>
</div>
@show