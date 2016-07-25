<?php 

namespace ICMS\Providers;

use Illuminate\Support\ServiceProvider;
use ICMS\Theme\ThemeManager;

class ThemeServiceProvider extends ServiceProvider {

	public function boot()
	{
		//Do Nothing
	}

	public function register()
	{
		$this->app->singleton('theme.manager', function ($app) {
			return new ThemeManager($app);
		});
	}

	public function provides()
	{
		return ['theme.manager'];
	}
}