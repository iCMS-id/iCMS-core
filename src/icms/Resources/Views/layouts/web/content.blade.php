@include('layouts.web.form')
<!-- @include('layouts.web.breadcrumb') -->

<div id="content">
	<div class="container">
		<div class="row">
			@section('content')
			@show
			@section('over.content')
			@show
		</div>
		<div class="row">
			@include('layouts.web.leftcontent')
			@include('layouts.web.rightcontent')
		</div>
	</div>
</div>