<?php 
namespace ICMS\Providers;

use Illuminate\Support\ServiceProvider;
use ICMS\Manager\SettingManager;
use ICMS\Facades\SettingFacade;

class SettingServiceProvider extends ServiceProvider{
	public function boot()
	{
		//Do Nothing
	}

	public function register()
	{
		$this->app->singleton('setting.manager', function ($app) {
			return new SettingManager($app);
		});
	}

	public function provides()
	{
		return [
			'setting.manager'
		];
	}
}