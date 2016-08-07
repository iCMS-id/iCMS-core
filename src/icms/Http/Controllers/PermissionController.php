<?php

namespace ICMS\Http\Controllers;

use Illuminate\Http\Request;
use ICMS\Http\Requests;
use ICMS\Models\Role;
use ICMS\Models\Permission;

class PermissionController extends Controller
{
	public function index($role_id)
	{
		$role = Role::find($role_id);

		if ($role) {
			$permissions = $role->permissions;

			return view('admin.permission.index', ['permissions' => $permissions, 'role' => $role]);
		}

		return redirect()->to(resolveRoute('admin.users'));
	}

	public function save($role_id, Request $request)
	{
		$role = Role::find($role_id);

		if ($role) {
			$permission = new Permission;
			$permission->permission = $request->permission;
			$permission->description = $request->description;

			$role->permissions()->save($permission);

			return redirect()->to(resolveRoute('admin.permission', ['role_id' => $role_id]));
		}

		return redirect()->to(resolveRoute('admin.users'));
	}

	public function delete($permission_id)
	{
		$permission = Permission::find($permission_id);

		if ($permission) {
			$role_id = $permission->role_id;
			$permission->delete();

			return redirect()->to(resolveRoute('admin.permission', ['role_id' => $role_id]));
		}

		return redirect()->to(resolveRotue('admin.users'));
	}

	public function ajax(Request $request)
	{
		$result = [];
		$permissions = Permission::all();

		$result['draw'] = $request->draw;
		$result['recordsTotal'] = $permissions->count();
		$result['recordsFiltered'] = $permissions->count();
		$result['data'] = [];

		$permissions = $permissions->splice($request->start ,$request->length);

		foreach ($permissions as $value) {
			$result['data'][] = [
				'ID' => $value->id,
				'Permission' => $value->permission,
				'Description' => $value->description,
			];
		}

		return response()->json($result);
	}
}
