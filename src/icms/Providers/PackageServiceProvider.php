<?php 

namespace ICMS\Providers;

use Illuminate\Support\ServiceProvider;
use ICMS\Console\Package\PackageCreateCommand;

class PackageServiceProvider extends ServiceProvider {

	public function boot()
	{
		//Do Nothing
	}

	public function register()
	{
		$this->app->singleton('package.manager', function ($app) {
			return new PackageManager($app);
		});
	}

	public function providers()
	{
		return [
			// 'package.create',
			'package.manager'
		];
	}
}