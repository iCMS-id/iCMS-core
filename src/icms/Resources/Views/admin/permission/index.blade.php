@extends('admin.base')

@section('title')
Detail Role
@endsection

@section('page.title')
Detail Role
@endsection

@section('page.content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Role <small>Role Detail</small></h2>
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
				<div class="form-horizontal form-label-left">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Role</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<p class="form-control-static">{{ $role->role }}</p>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<p class="form-control-static">{{ $role->description }}</p>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Permission Count</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<p class="form-control-static">{{ $permissions->count() }}</p>
						</div>
					</div>
					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
							<a href="{{ resolveRoute('admin.users') }}" class="btn btn-primary">Back</a>
							<a href="{{ resolveRoute('admin.role.edit', ['id' => $role->id]) }}" class="btn btn-success">Edit</a>
							<a href="{{ resolveRoute('admin.role.delete', ['id' => $role->id]) }}" class="btn btn-danger">Delete</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Permissions <small>Permissions list</small></h2>
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
				<button class="btn btn-info" id="add-permission"><i class="fa fa-plus"></i> Add</button>
				<table class="table" id="data-role">
					<thead>
						<tr>
							<th>#ID</th>
							<th>Permission</th>
							<th>Description</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($permissions as $value)
						<tr>
							<td>{{ $value->id }}</td>
							<td>{{ $value->permission }}</td>
							<td>{{ $value->description }}</td>
							<td>
								<a href="{{ resolveRoute('admin.permission.delete', ['permission_id' => $value->id]) }}">Delete</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Modal Add Pustaka -->
<div class="modal fade" id="modal-permission" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Tambah Permission</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="{{ resolveRoute('admin.permission.save', ['role_id' => $role->id]) }}" class="form-horizontal">
					{!! csrf_field() !!}
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Permission</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="permission" class="form-control" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<textarea class="form-control" name="description"></textarea>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success" id="submit-form">Submit</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		$('#modal-permission').modal({show:false});
		$('#add-permission').click(function () {
			$('#modal-permission').modal('show');
		});

		$('#submit-form').click(function () {
			$('#modal-permission form').submit();
		});
	});
</script>
@endsection