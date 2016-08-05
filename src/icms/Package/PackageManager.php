<?php 

namespace ICMS\Package;

use File;
use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;

class PackageManager {
	protected $app;
	protected $package_path;
	protected $current_package;

	protected $listPackage = [];
	protected $activePackage = [];

	public function __construct($app)
	{
		$this->app = $app;
		$this->package_path = $app['path.base'] . '/' . $app['config']['icms.package_path'];
		$this->scanDir();
	}

	protected function loadPackageJSON()
	{
		return $this->readJSON($this->package_path . '/package.json', true);
	}

	protected function scanDir()
	{
		$package_composers = File::glob($this->package_path . '/*/*/composer.json');
		$package_json = $this->loadPackageJSON()['active'];

		foreach ($package_composers as $json_file)
		{
			$json = $this->readJSON($json_file);
			$json->path = str_replace('/composer.json', null, $json_file);
			$package = new Package($this->app, $json);
			
			$this->listPackage[$package->name] = $package;

			if (in_array($package->name, $package_json)) {
				$this->activePackage[$package->name] = $package;
			}
		}
	}

	public function getPackages()
	{
		return $this->listPackage;
	}

	public function getPackage($name)
	{
		if (array_key_exists($name, $this->listPackage)) {
			return $this->listPackage[$name];
		}

		return null;
	}

	public function getPackageBySlug($slug)
	{
		$packages = $this->getEnabled();

		foreach ($packages as $package) {
			if ($package->slug == $slug) {
				return $package;
			}
		}

		return null;
	}

	public function getPackagePath()
	{
		return $this->package_path;
	}

	public function getEnabled()
	{
		return $this->activePackage;
	}

	public function getDisabled()
	{
		return array_diff($this->listPackage, $this->activePackage);
	}

	public function getCurrent()
	{
		return $this->current_package;
	}

	public function registerPackages()
	{
		$packages = $this->getEnabled();

		foreach ($packages as $package) {
			$this->registerProviders($package);
			$this->registerMenu($package);
		}

		$this->detectPackage();
	}

	protected function registerMenu($package)
	{
		$menus = $package->getMenu();

		$this->app['menu.manager']->registerMenu($menus, 'apps');
	}

	public function registerPackageMenu()
	{
		$menus = [];
		$packages = $this->getAllPackages(true);

		foreach ($packages as $package) {
			$file = require ($package->path . '/' . $package->menu);
			$menu = $this->resolveMenu($package, $file);
			
			$menus = array_merge($menus, $menu);
		}

		$this->app['menu.manager']->registerMenu($menus, 'apps');
	}

	protected function registerProviders(Package $package)
	{
		$providers = $package->providers;

		foreach ($providers as $provider) {
			$this->app->register($provider);
		}
	}

	protected function detectPackage()
	{
		$result = [];
		$preg = preg_match("/[a-zA-Z]{2}\/(admin\/apps|apps)\/([^\/]+)/", $this->app['request']->path(), $result);

		if ($preg == 1) {
			$package_slug = $result[2];

			$package = $this->getPackageBySlug($package_slug);

			if (!is_null($package)) {
				$this->setCurrent($package);
				$this->reloadEnv();
			}
		}
	}

	protected function reloadEnv()
	{
		$package = $this->getCurrent();

		$this->setEnvironmentPath($package->path);

		(new Dotenv($this->app->environmentPath()))->overload();

		$this->app->bootstrapWith(['Illuminate\Foundation\Bootstrap\LoadConfiguration']);
	}

	public function setCurrent($package)
	{
		$this->current_package = $package;
		return $this;
	}

	protected function setEnvironmentPath($path)
	{
		$this->app->useEnvironmentPath($path);
		return $this;
	}

	protected function readJSON($path, $to_array = false)
	{
		if (File::exists($path)) {
			return json_decode(File::get($path), $to_array);
		}

		return null;
	}

	public function publishAsset($package_name = null)
	{
		$package = $this->getAllPackages(true);

		foreach ($package as $pack)
		{
			if (!is_null($package_name)) {
				if ($package_name == $pack->name) {
					return $this->packageAsset($package);
				}
			} else {
				$this->packageAsset->publishAsset($pack);
			}
		}

		return true;
	}

	public function asset($path)
	{
		$package = $this->getCurrent();

		return $package->getPackageAsset()->resolveAsset($path);
	}

	public function view($view, $data = [], $title = null)
	{
		$package = $this->getCurrent();

		return $package->getPackageView()->makeView($view, $data, $title);
	}

	public function route($route_name, $data = [])
	{
		$data = array_merge($data, ['lang' => $this->app['config']['app.locale']]);
		
		return route($route_name, $data);
	}

	public function enablePackage($packages)
	{
		//
	}

	public function disablePackage($packages)
	{
		//
	}
}