<?php 

namespace ICMS\Foundation;

use Illuminate\Foundation\Application as Laravel;

class Application extends Laravel {
	public function path()
	{
		return realpath(__DIR__.'/..');
	}

	public function langPath()
	{
		return $this->path() . '/Resources/Lang';
	}
}