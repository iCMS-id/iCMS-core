<?php 

namespace ICMS\Facades;

use Illuminate\Support\Facades\Facade;

class WidgetFacade extends Facade {
	
	protected static function getFacadeAccessor()
	{
		return 'widget.manager';
	}
}