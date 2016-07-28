<?php 

namespace ICMS\Providers;

use Illuminate\Support\ServiceProvider;
use ICMS\Package\PackageManager;

class PackageServiceProvider extends ServiceProvider {

	public function boot()
	{
		$this->app['package.manager']->detectPackageByPath();
		$this->app['package.manager']->registerPackageMenu();
	}

	public function register()
	{
		$this->app->singleton('package.manager', function ($app) {
			return new PackageManager($app);
		});
	}

	public function provides()
	{
		return [
			'package.manager'
		];
	}
}