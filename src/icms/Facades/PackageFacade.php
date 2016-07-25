<?php

namespace ICMS\Facades;

use Illuminate\Support\Facades\Facade;

class PackageFacade extends Facade {

	protected static function getFacadeAccessor()
	{
		return 'package.manager';
	}
}