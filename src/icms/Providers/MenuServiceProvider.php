<?php 

namespace ICMS\Providers;

use Illuminate\Support\ServiceProvider;
use ICMS\Menu\MenuManager;
use Route;

class MenuServiceProvider extends ServiceProvider {
	
	public function boot()
	{
		//
	}

	public function register()
	{
		$this->app->singleton('menu.manager', function ($app) {
			return new MenuManager($app);
		});
	}

	public function provides()
	{
		return [
			'menu.manager'
		];
	}
}