<?php 

namespace ICMS\Providers;

use Illuminate\Support\ServiceProvider;
use View;

class ICMSServiceProvider extends ServiceProvider {
	public function boot()
	{
		$this->registerNamespaces();
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
		$this->registerSingleton();
		$this->registerCommand();
	}

	public function registerPath()
	{
		View::addLocation(app_path() . '/Resources/Views');
	}

	public function registerSingleton()
	{
		$this->app->singleton('package.db.seed', function ($app) {
			return new \ICMS\Console\Package\PackageSeedCommand($app['db'], $app['files']);
		});
		$this->app->singleton('package.make.migration', function ($app) {
			return new \ICMS\Console\Package\PackageMakeMigrateCommand($app['files']);
		});
		$this->app->singleton('package.make.controller', function ($app) {
			return new \ICMS\Console\Package\PackageMakeControllerCommand($app['files']);
		});
		$this->app->singleton('package.make.model', function ($app) {
			return new \ICMS\Console\Package\PackageMakeModelCommand($app['files']);
		});
		$this->app->singleton('package.migration', function ($app) {
			return new \ICMS\Console\Package\PackageMigrateCommand($app['migrator']);
		});
		$this->app->singleton('package.migration.reset', function ($app) {
			return new \ICMS\Console\Package\PackageMigrateResetCommand($app['migrator']);
		});
		$this->app->singleton('package.migration.refresh', function ($app) {
			return new \ICMS\Console\Package\PackageMigrateRefreshCommand();
		});
	}

	public function registerCommand()
	{
		$this->commands('package.db.seed');
		$this->commands('package.make.controller');
		$this->commands('package.make.migration');
		$this->commands('package.make.model');
		$this->commands('package.migration');
		$this->commands('package.migration.reset');
		$this->commands('package.migration.refresh');
	}

	protected function registerNamespaces()
	{
		$configPath = __DIR__.'/../../config/icms.php';
		
		$this->mergeConfigFrom($configPath, 'icms');
		$this->publishes([
			$configPath => config_path('icms.php')
		], 'config');
	}
}