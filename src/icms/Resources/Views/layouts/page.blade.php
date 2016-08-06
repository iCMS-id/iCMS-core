<div class="right_col" role="main">
	@section('content')
	@show

	@if ($errors->count() > 0)
		@foreach($errors->all() as $error)
			<div class="text-danger">{{ $error }}</div>
		@endforeach
	@endif
</div>