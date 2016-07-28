<?php 

namespace ICMS\Providers;

use Illuminate\Support\ServiceProvider;
use View;

class ICMSServiceProvider extends ServiceProvider {
	public function boot()
	{
		//Do Nothing
	}

	public function register()
	{
		$this->app->register(AuthServiceProvider::class);
		$this->app->register(EventServiceProvider::class);
		$this->app->register(RouteServiceProvider::class);
		$this->app->register(LanguageServiceProvider::class);
		$this->app->register(MenuServiceProvider::class);
		$this->app->register(PackageServiceProvider::class);
		$this->app->register(ThemeServiceProvider::class);
		$this->app->register(WidgetServiceProvider::class);

		$this->registerPath();
	}

	public function registerPath()
	{
		View::addLocation(app_path() . '/Resources/Views');
	}
}