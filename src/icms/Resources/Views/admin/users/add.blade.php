@extends('admin.base')

@section('title')
Tambah User
@endsection

@section('page.title')
Tambah User
@endsection

@section('panel.title')
Tambah User
@endsection

@section('panel.content')
<form class="form-horizontal form-label-left" method="post">
	{!! csrf_field() !!}
	<div class="form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12">Username <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input class="form-control" type="text" name="name" maxlength="60" required="">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12">Password <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input class="form-control" type="password" name="password" maxlength="60" required="">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12">E-Mail <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input class="form-control" type="email" name="email" maxlength="60" required="">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12">Activated User</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="checkbox" name="is_active" class="js-switch" /> 
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12">Roles <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<select multiple="" id="select-role" name="roles[]" class="form-control" required="">
				<option></option>
				@foreach($role as $value)
				<option value="{{ $value->id }}">{{ $value->role }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="ln_solid"></div>
	<div class="form-group">
		<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
			<a href="{{ resolveRoute('admin.users') }}" class="btn btn-primary">Cancel</a>
			<button type="submit" class="btn btn-success">Submit</button>
		</div>
	</div>
</form>

<link rel="stylesheet" type="text/css" href="{{ asset('css/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/switchery.min.css') }}">
<script type="text/javascript" src="{{ asset('js/select2.full.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/switchery.min.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$('#select-role').select2({
			placeholder: "Select a role"
		});
	});
</script>
@endsection