<?php

namespace ICMS\Http\Controllers;

use Illuminate\Http\Request;
use ICMS\Http\Requests;
use ICMS\Models\User;
use ICMS\Models\Role;

class UsersController extends Controller
{
	public function index()
	{
		return view('admin.users.index');
	}

	public function add()
	{
		$role = Role::all();
		return view('admin.users.add', ['role' => $role]);
	}

	public function save(Request $request)
	{
		$user = new User;

		$user->name = $request->name;
		$user->password = bcrypt($request->password);
		$user->email = $request->email;
		$user->is_active = $request->has('is_active');
		$user->save();

		$user->roles()->attach($request->roles);

		return redirect()->to(resolveRoute('admin.users'));
	}

	public function ajax(Request $request)
	{
		$result = [];
		$formats = User::all();

		$result['draw'] = $request->draw;
		$result['recordsTotal'] = $formats->count();
		$result['recordsFiltered'] = $formats->count();
		$result['data'] = [];

		$formats = $formats->splice($request->start ,$request->length);

		foreach ($formats as $value) {
			$result['data'][] = [
				'ID' => $value->id,
				'Username' => $value->name,
				'Email' => $value->email,
				'Status' => $value->is_active
			];
		}

		return response()->json($result);
	}

	public function edit($id = null)
	{
		$user = User::find($id);
		$roles = Role::all();

		if ($user) {
			return view('admin.users.edit', ['user' => $user, 'role' => $roles]);
		}

		return redirect()->to(resolveRoute('admin.users'));
	}

	public function update($id = null , Request $request)
	{
		$user = User::find($id);

		if ($user) {
			$user->name = $request->name;
			$user->email = $request->email;
			$user->is_active = $request->has('is_active');
			$user->save();

			$user->roles()->detach();
			$user->roles()->attach($request->roles);
		}

		return redirect()->to(resolveRoute('admin.users'));
	}

	public function delete($id = null)
	{
		$user = User::find($id);

		if ($user) {
			$user->delete();
		}

		return redirect()->to(resolveRoute('admin.users'));
	}
}
