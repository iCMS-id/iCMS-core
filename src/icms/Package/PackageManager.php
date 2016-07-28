<?php 

namespace ICMS\Package;

use File;

class PackageManager {
	protected $app;
	protected $package_path;
	protected $packageView;
	protected $packageAsset;
	protected $current_active_package;

	protected $listPackage;
	protected $activePackage;

	public function __construct($app)
	{
		$this->app = $app;
		$this->listPackage = [];
		$this->activePackage = [];
		$this->package_path = $app['path.base'] . '/package';
		$this->packageView = new PackageView($app, $this->current_active_package);
		$this->packageAsset = new PackageAsset($app, $this->current_active_package);
	}

	public function getPackagePath()
	{
		return $this->package_path;
	}

	public function detectPackageByPath()
	{
		$result = [];
        $preg = preg_match("/[a-zA-Z]{2}\/(admin\/apps|apps)\/([^\/]+)/", $this->app['request']->path(), $result);

        if ($preg == 1) {
            $package_slug = $result[2];

            $this->registerPackageBySlug($package_slug);
        }
	}

	public function registerPackageBySlug($slug)
	{
		$allpackage = $this->getAllPackages(true);

		foreach ($allpackage as $package)
		{
			if ($slug == $package->slug) {
				foreach ($package->providers as $provider) {
					$this->app->register($provider);
				}

				$this->setPackage($package);
			}
		}

		return true;
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

	public function resolveMenu($package, $arr_menu)
	{
		$data = [];

		foreach ($arr_menu as $key => $menu) {
			if (is_array($menu)) {
				$data[$key] = $this->resolveMenu($package, $menu);
			} else {
				$data[$key] = $this->resolveUrl($package, $menu);
			}
		}

		return $data;
	}

	public function resolveUrl($package, $path)
	{
		return route('admin.apps') . '/' . $package->slug . '/' . $path;
	}

	public function getAllPackages($active_only = false)
	{
		if (count($this->listPackage) > 0) {
			if ($active_only) {
				return $this->activePackage;
			} else {
				return $this->listPackage;
			}
		}

		$list = [];
		$activepackage = $this->readJSON($this->package_path . '/package.json', true)['active'];
		$packages = File::glob($this->package_path . '/*/*/composer.json');
		
		foreach ($packages as $json_file)
		{
			$json = $this->readJSON($json_file);
			$path = str_replace('/composer.json', null, $json_file);
			
			if (is_array($json)) {
				$json['path'] = $path;
			} else {
				$json->path = $path;
			}

			$this->listPackage[] = $json;

			if ($active_only) {
				if (in_array($json->name, $activepackage)) {
					$list[] = $json;
					$this->activePackage[] = $json;
				}
			} else {
				$list[] = $json;
			}
		}

		return $list;
	}

	public function readMeta($vendor, $package)
	{
		//
	}

	public function readJSON($path, $to_array = false)
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
		return $this->packageAsset->resolveAsset($path);
	}

	public function view($view, $data = [])
	{
		return $this->packageView->makeView($view, $data);
	}

	public function enablePackage($packages)
	{
		//
	}

	public function disablePackage($packages)
	{
		//
	}

	public function getPackageInfo($package)
	{
		// return $this->current_active_package;
	}

	public function getCurrentPackage()
	{
		return $this->current_active_package;
	}

	public function setPackage($package)
	{
		$this->current_active_package = $package;
		$this->packageView->setPackage($package);
		$this->packageAsset->setPackage($package);

		return $this;
	}
}