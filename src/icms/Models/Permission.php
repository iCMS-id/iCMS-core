<?php 
namespace ICMS\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model {
	public function roles()
	{
		return $this->belongsTo(Role::class);
	}
}