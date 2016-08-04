<?php

namespace ICMS\Http\Controllers;

use Illuminate\Http\Request;
use ICMS\Http\Requests;
use ICMS\Models\Role;

class RolesController extends Controller
{
	public function add()
	{
		return view('admin.role.add');
	}

	public function save(Request $request)
	{
		$role = new Role;

		$role->role = $request->role;
		$role->description = $request->description;
		$role->save();

		return redirect()->to(resolveRoute('admin.users'));
	}

	public function ajax(Request $request)
	{
		$result = [];
		$formats = Role::all();

		$result['draw'] = $request->draw;
		$result['recordsTotal'] = $formats->count();
		$result['recordsFiltered'] = $formats->count();
		$result['data'] = [];

		$formats = $formats->splice($request->start ,$request->length);

		foreach ($formats as $value) {
			$result['data'][] = [
				'ID' => $value->id,
				'Role' => $value->role,
				'Description' => $value->description,
				'Permissions' => $value->permissions->count()
			];
		}

		return response()->json($result);
	}

	public function edit($id = null)
	{
		$role = Role::find($id);

		if ($role) {
			return view('admin.role.edit', ['role' => $role]);
		}

		return redirect()->to(resolveRoute('admin.users'));
	}

	public function update($id, Request $request)
	{
		$role = Role::find($id);

		if ($role) {
			$role->role = $request->role;
			$role->description = $request->description;
			$role->save();

			return redirect()->to(resolveRoute('admin.users'));
		}

		return redirect()->back()->withErrors(['role' => 'Role not found.']);
		
	}

	public function delete($id = null)
	{
		$role = Role::find($id);

		if ($role) {
			$role->delete();
		}

		return redirect()->to(resolveRoute('admin.users'));
	}
}
