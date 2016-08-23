<?php 

namespace ICMS\Package;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider{

	protected $namespace = '';
	protected $slug = '';
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
		$package = $this->app['package.manager']->getPackageBySlug($this->slug);

		if (! is_null($package)) {
			$path = $package->path;
			$slug = $package->slug;

			$router->group([ 'namespace' => $this->namespace, 'middleware' => 'web', 'prefix' => '{lang?}'], function ($router) use ($slug, $path) {
				$router->group(['prefix' => 'admin/apps/' . $slug, 'middleware' => 'auth'], function ($router) use ($path) {
					require $path . '/Http/adminroute.php';
				});
				$router->group(['prefix' => 'apps/' . $slug, 'middleware' => 'web.page'], function ($router) use ($path) {
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