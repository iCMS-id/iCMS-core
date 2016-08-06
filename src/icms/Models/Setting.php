<?php

namespace ICMS\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $casts = ['settings' => 'array'];
}
