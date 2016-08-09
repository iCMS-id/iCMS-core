<?php

namespace ICMS\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function comments()
    {
    	return $this->morphToMany(Comment::class, 'commentable');
    }
}
