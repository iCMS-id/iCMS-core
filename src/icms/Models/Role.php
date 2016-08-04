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
}