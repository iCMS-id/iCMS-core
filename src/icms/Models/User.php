<?php 
namespace ICMS\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Event;
use ICMS\Auth\User as UserMirror;

class User extends Authenticatable {
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	public function roles()
	{
		return $this->belongsToMany(Role::class);
	}

	public function attachRole($arr)
	{
		$this->roles()->attach($arr);
		$this->fireEvent();
		return $this;
	}

	public function syncRole($arr)
	{
		$this->roles()->sync($arr);
		$this->fireEvent();
		return $this;
	}

	public function detachRole($arr)
	{
		$this->roles()->detach($arr);
		$this->fireEvent();
		return $this;
	}

	protected function fireEvent()
	{
		Event::fire('user.role.changed', [new UserMirror($this)]);
	}

	public function hasRole($role)
	{
		$roles = $this->roles;
		
		if (is_string($role)) {
			return $roles->contains('role', $role);
		} else {
			return $roles->contains('id', $role->id);
		}
	}

	public function hasPermission($permission)
	{
		$roles = $this->roles;

		foreach ($roles as $role) {
			if ($role->hasPermission($permission)) {
				return true;
			}
		}

		return false;
	}

	protected static function boot()
	{
		parent::boot();

		static::deleting(function ($user) {
			return ($user->id > 1);
		});

		static::deleted(function ($user) {
			Event::fire('user.deleted', [new UserMirror($user)]);
		});

		static::created(function ($user) {
			Event::fire('user.created', [new UserMirror($user)]);
		});
	}
}