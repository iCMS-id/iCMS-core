<?php 

namespace ICMS\Package;

use ICMS\Models\Menu;
use ICMS\Models\Role;
use ICMS\Models\Permission;
use Illuminate\Database\QueryException;

class Package {
	protected $asset;
	protected $view;
	protected $package;
	protected $menu = [];
	protected $app;

	public function __construct($app, $package)
	{
		$this->package = $package;
		$this->app = $app;
		$this->view = new PackageView($app, $package);
		$this->asset = new PackageAsset($app, $package);
		$this->refreshMenu();
	}

	public function __get($key)
	{
		return $this->package->$key;
	}

	public function registerMenu()
	{
		$this->deleteMenu();

		$file = require ($this->package->path . '/' . $this->package->menu);
		$this->resolveMenu($file);

		$roots = Menu::roots()->get();
		$parent = $roots->where('name', 'apps')->first();
		$menus = $roots->where('package_name', $this->package->name);

		foreach ($menus as $menu) {
			$menu->makeChildOf($parent);
		}

		$this->refreshMenu();
	}

	protected function deleteMenu()
	{
		foreach ($this->menu as $menu) {
			$menu->delete();
		}
	}

	protected function refreshMenu()
	{
		$root = Menu::roots()->where('name', 'apps')->first();

		if ($root) {
			$descendants = $root->getDescendants(1);

			if (!is_null($descendants)) {
				$this->menu = $descendants->where('package_name', $this->package->name);
			}
		}
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

	public function resolveMenu($arr_menu, Menu $parent = null)
	{
		$package = $this->package;

		foreach ($arr_menu as $key => $menu) {
			if (is_array($menu)) {
				$node = Menu::create(['name' => $key, 'package_name' => $package->name]);
				$this->resolveMenu($menu, $node);
			} else {
				$node = Menu::create([
					'name' => $key,
					'package_name' => $package->name,
					'options' => [
						'type' => 'url',
						'target' => 'self',
						'route' => $menu
					]
				]);
			}

			if (!is_null($parent)) {
				$node->makeChildOf($parent);
			}
		}
	}

	// protected function resolveUrl($path)
	// {
	// 	$package = $this->package;
		
	// 	return resolveRoute('admin.apps') . '/' . $package->slug . '/' . $path;
	// }
}