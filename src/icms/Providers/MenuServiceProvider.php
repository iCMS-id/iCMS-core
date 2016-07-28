<?php 

namespace ICMS\Providers;

use Illuminate\Support\ServiceProvider;
use ICMS\Menu\MenuManager;
use Route;

class MenuServiceProvider extends ServiceProvider {
	
	public function boot()
	{
		$this->registerMenu();
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

	public function registerMenu()
	{
		$menu = require __DIR__ . '/../Http/menu.php';
		$this->app['menu.manager']->registerMenu($menu);
	}
}