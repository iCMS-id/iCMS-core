<?php 
namespace ICMS\Auth;

use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use ICMS\Auth\User as UserClass;
use ICMS\Models\User;
use ICMS\Models\Role;
use ICMS\Models\Permission;

class AuthManager {

	protected $gate;
	protected $app;

	public function __construct(Gate $gate, $app)
	{
		$this->gate = $gate;
		$this->app = $app;
		$this->defineGate();
	}

	public function getUsers()
	{
		$users = User::all();
		$usermodel = new Collection;

		foreach ($users as $user) {
			$usermodel->push(new UserClass($user));
		}

		return $usermodel;
	}

	public function getUser($id)
	{
		$user = User::findOrFail($id);
		return new UserClass($user);
	}

	public function getRoles()
	{
		try {
			$roles = Role::all();

			return $roles->toArray();
		} catch (QueryException $ex) {
			return [];
		}
	}

	protected function defineGate()
	{
		try {
			$roles = Role::all();
		} catch (QueryException $ex) {
			return;
		}

		foreach ($roles as $role) {
			$this->defineRole($role);

			try {
				$permissions = $role->permissions;

				foreach ($permissions as $permission) {
					$this->definePermission($role, $permission);
				}
			} catch (QueryException $ex) {
				//
			}
		}
	}

	protected function defineRole($role)
	{
		$this->gate->define($role->role, function ($user) use ($role) {
			return $user->hasRole($role);
		});
	}

	protected function definePermission($role, $permission)
	{
		$this->gate->define($role->role . ':' . $permission->permission, function ($user) use ($permission) {
			return $user->hasPermission($permission);
		});
	}
}