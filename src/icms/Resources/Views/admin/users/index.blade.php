@extends('admin.base')

@section('title')
Users Management
@endsection

@section('page.title')
Users <small>Users Management</small>
@endsection

@section('page.content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Users <small>User List</small></h2>
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
				<a class="btn btn-info" href="{{ resolveRoute('admin.users.add') }}"><i class="fa fa-plus"></i> Add</a>
				<table class="table" id="data-user">
					<thead>
						<tr>
							<th>#ID</th>
							<th>Username</th>
							<th>E-Mail</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Roles <small>User role</small></h2>
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
				<a class="btn btn-info" href="{{ resolveRoute('admin.role.add') }}"><i class="fa fa-plus"></i> Add</a>
				<table class="table" id="data-role">
					<thead>
						<tr>
							<th>#ID</th>
							<th>Role</th>
							<th>Description</th>
							<th>Permissions</th>
							<th>Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>

<link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.bootstrap.min.css') }}">

<script type="text/javascript" src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/buttons.bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/responsive.bootstrap.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$('#data-user').DataTable({
			serverSide: true,
			ajax: {
				url: "{{ resolveRoute('admin.users.ajax') }}",
				type: "POST"
			},
			columns: [
				{data: "ID"},
				{data: "Username"},
				{data: "Email"},
				{
					data: "Status",
					className: "text-center",
					fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
						if (oData.Status) {
							$(nTd).html('<i class="fa fa-check text-success"></i>');
						} else {
							$(nTd).html('<i class="fa fa-times text-danger"></i>');
						}
					}
				},
				{
					data: "ID",
					className: "text-center",
					fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
						var content = "<a href=\"{{ resolveRoute('admin.users.edit') }}/"+oData.ID+"\">Edit</a>";
						content += " <a href=\"{{ resolveRoute('admin.users.delete') }}/"+oData.ID+"\">Delete</a>";
						$(nTd).html(content);
					}
				}
			],
			responsive: false,
			ordering: false
		});

		$('#data-role').DataTable({
			serverSide: true,
			ajax: {
				url: "{{ resolveRoute('admin.role.ajax') }}",
				type: "POST"
			},
			columns: [
				{data: "ID"},
				{data: "Role"},
				{data: "Description"},
				{data: "Permissions"},
				{
					data: "ID",
					className: "text-center",
					fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
						var content = "<a href=\"{{ resolveRoute('admin.permission') }}/"+oData.ID+"\">Permission</a>";
						content += " <a href=\"{{ resolveRoute('admin.role.edit') }}/"+oData.ID+"\">Edit</a>";
						content += " <a href=\"{{ resolveRoute('admin.role.delete') }}/"+oData.ID+"\">Delete</a>";
						$(nTd).html(content);
					}
				}
			],
			responsive: false,
			ordering: false
		});
	});
</script>
@endsection