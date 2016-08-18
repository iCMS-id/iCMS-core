<?php 

namespace ICMS\Package;

use Illuminate\Support\ServiceProvider;

class PackageServiceProvider extends ServiceProvider {
	protected $menus = [];
	protected $providesRoute = [];

	public function boot()
	{
		//
	}

	public function register()
	{
		//
	}

	public static function getProvidesRoute()
	{
		return (new static(app()))->providesRoute;
	}
}