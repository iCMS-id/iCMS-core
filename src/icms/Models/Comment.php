<?php

namespace ICMS\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	public function posts()
	{
		return $this->morphedByMany(Post::class, 'commentable');
	}
	
    public function commentable()
    {
    	return $this->morphTo();
    }
}
