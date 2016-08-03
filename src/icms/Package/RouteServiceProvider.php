<?php 

namespace ICMS\Package;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider{

	protected $namespace = '';
	protected $middleware = [];

	public function boot(Router $router)
	{
		//
		parent::boot($router);
	}

	public function map(Router $router)
	{
		$this->registerMiddleware($router);
		$this->mapWebRoutes($router);

		//
	}

	protected function mapWebRoutes(Router $router)
	{
		$package = $this->app['package.manager']->getCurrentPackage();

		if (! is_null($package)) {
			$slug = $package->slug;
			$path = $package->path;

			$router->group([ 'namespace' => $this->namespace, 'middleware' => 'web', 'prefix' => '{lang?}'], function ($router) use ($slug, $path) {
				$router->group(['prefix' => 'admin/apps/' . $slug, 'middleware' => 'auth'], function ($router) use ($path) {
					require $path . '/Http/adminroute.php';
				});
				$router->group(['prefix' => 'apps/' . $slug], function ($router) use ($path) {
					require $path . '/Http/webroute.php';
				});
			});
		}
	}

	protected function registerMiddleware(Router $router)
	{
		foreach ($this->middleware as $key => $class)
		{
			$router->middleware($key, $class);
		}
	}
}