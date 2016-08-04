<?php 
namespace ICMS\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {
	public $timestamps = false;

	public function users()
	{
		return $this->belongsToMany(User::class);
	}

	public function permissions()
	{
		return $this->hasMany(Permission::class);
	}

	public function hasPermission(Permission $permission)
	{
		$permissions = $this->permissions;

		if (is_string($permission)) {
			return $permissions->contains('permission', $permission);
		} else {
			return $permissions->contains('id', $permission->id);
		}
	}

	protected static function boot()
    {
        parent::boot();

        static::deleting(function ($role) {
            return ($role->id > 2);
        });
    }
}