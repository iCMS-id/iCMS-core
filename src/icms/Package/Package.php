<?php 

namespace ICMS\Package;

use ICMS\Models\Role;
use ICMS\Models\Permission;
use Illuminate\Database\QueryException;

class Package {
	protected $asset;
	protected $view;
	protected $package;
	protected $menu;
	protected $app;

	public function __construct($app, $package)
	{
		$this->package = $package;
		$this->app = $app;
		$this->view = new PackageView($app, $package);
		$this->asset = new PackageAsset($app, $package);
		$this->registerMenu();
	}

	public function __get($key)
	{
		return $this->package->$key;
	}

	protected function registerMenu()
	{
		$file = require ($this->package->path . '/' . $this->package->menu);
		$this->menu = $this->resolveMenu($this->package, $file);
	}

	public function registerRoles()
	{
		if (property_exists($this->package, 'roles')) {
			$roles = $this->package->roles;

			foreach ($roles as $role) {
				$rolemodel = new Role;
				$rolemodel->role = $role->name;
				$rolemodel->description = $role->description;

				try {
					$rolemodel->save();

					$this->registerPermission($rolemodel, $role->permissions);
				} catch (QueryException $ex) {
					//
				}
			}
		}
	}

	protected function registerPermission($role, $permissions)
	{
		foreach ($permissions as $permission) {
			$model = new Permission;
			$model->permission = $permission->name;
			$model->description = $permission->description;

			$role->permissions()->save($model);
		}
	}

	public function getPackageAsset()
	{
		return $this->asset;
	}

	public function getPackageView()
	{
		return $this->view;
	}

	public function getMenu()
	{
		return $this->menu;
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

	protected function resolveUrl($package, $path)
	{
		$x = $this->app['request']->path();
		list($lang) = explode('/', $x);

		if (strlen($lang) !=2)
			$lang = $this->app['config']['app.locale'];
		
		return route('admin.apps', ['lang' => $lang]) . '/' . $package->slug . '/' . $path;
	}
}