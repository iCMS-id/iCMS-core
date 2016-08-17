<?php

namespace ICMS\Models;

use Illuminate\Database\Eloquent\Model;
use Baum\Node;

class Menu extends Node
{
	use MetableTrait;

	protected $leftColumn = 'left';
	protected $rightColumn = 'right';
	protected $guarded = ['parent_id', 'left', 'right', 'depth'];
   	protected $casts = ['options' => 'array'];

   	public $timestamps = false;
   	public $metafield = 'options';
	public $metadata = ['type', 'route', 'url', 'package', 'target'];
}
