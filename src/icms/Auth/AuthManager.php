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
		return User::findOrFail($id);
	}

	public function getRoles()
	{
		return Role::all()->toArray();
	}

	protected function defineGate()
	{
		$roles = Role::all();

		foreach ($roles as $role) {
			$this->defineRole($role);

			$permissions = $role->permissions;

			foreach ($permissions as $permission) {
				$this->definePermission($role, $permission);
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