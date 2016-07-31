<?php 
namespace ICMS\Permission;

use Illuminate\Contracts\Auth\Access\Gate;
use ICMS\Models\User;
use ICSM\Models\Role;
use ICMS\Models\Permission;

class AuthManager {

	protected $gate;
	protected $app;

	public function __construct(Gate $gate, $app)
	{
		$this->gate = $gate;
		$this->app = $app;
		$this->registerPermission();
	}

	public function getUsers()
	{
		$users = User::all();

		$users->filters(function ($key, $value) {
			return $value;
		});

		return $users;
	}

	public function getUser($id)
	{
		return User::findOrFail($id);
	}

	public function getRoles()
	{
		return Role::all();
	}

	protected function registerPermission()
	{
		$this->gate->before(function ($user, $ability) {
			$role = $user->role;

			if ($role->is_admin)
				return true;
        });

        $this->defineGate();
	}

	protected function defineGate()
	{
		$permissions = Permission::all();

		foreach ($permissions as $permission)
		{
			$ability = $permission->permission;

			$this->gate->define($ability, function ($user) use ($ability) {
				$role = $user->role;

				if (! is_null($role)) {
					$there = $role->permissions->where('permission', $ability);
					return $there->count() > 0;
				}

				return false;
			});
		}
	}
}