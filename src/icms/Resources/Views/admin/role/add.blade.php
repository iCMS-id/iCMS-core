@extends('admin.base')

@section('page.title')
Tambah Role
@endsection

@section('panel.title')
Tambah Role
@endsection

@section('panel.content')
<form class="form-horizontal form-label-left" method="post">
	{!! csrf_field() !!}
	<div class="form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12">Role <span class="required">*</span></label>
		<div class="col-md-3 col-sm-3 col-xs-12">
			<input class="form-control" type="text" name="format" maxlength="60">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<textarea class="form-control" rows="2" name="keterangan" maxlength="255"></textarea>
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
@endsection