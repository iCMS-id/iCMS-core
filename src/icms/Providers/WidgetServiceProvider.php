<?php 

namespace ICMS\Providers;

use Illuminate\Support\ServiceProvider;
use ICMS\Widget\WidgetManager;
use Request;

class WidgetServiceProvider extends ServiceProvider {
	
	public function boot()
	{
		//Do Nothing
	}

	public function register()
	{
		$this->app->singleton('widget.manager', function ($app) {
			return new WidgetManager($app);
		});
	}

	public function provides()
	{
		return ['widget.manager'];
	}
}