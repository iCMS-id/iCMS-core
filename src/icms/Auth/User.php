<?php 
namespace ICMS\Auth;

use ICMS\Models\User as UserModel;

class User {

	protected $model;

	public function __construct(UserModel $model)
	{
		$this->model = $model;
	}

	public function getRoles()
	{
		return $this->model->roles->toArray();
	}

	public function hasRole($role)
	{
		return $this->model->hasRole($role);
	}

	public function hasPermission($permission)
	{
		return $this->model->hasPermission($permission);
	}

	public function __get($key)
	{
		if ($key == 'password') {
			return null;
		} elseif ($key == 'roles') {
			return $this->getRoles();
		}

		return $this->model->$key;
	}

	public function __debugInfo()
	{
		return [
			'id' => $this->model->id,
			'name' => $this->model->name,
			'email' => $this->model->email,
			'avatar' => $this->model->avatar,
			'is_active' => $this->model->is_active,
			'roles' => $this->getRoles()
		];
	}
}