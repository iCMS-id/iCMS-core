<?php 

namespace ICMS\Menu;

use Illuminate\Support\Str;

class MenuManager {
	protected $app;
	protected $view;
	protected $menus;
	protected $container, $parent, $child;

	public function __construct($app)
	{
		$this->app = $app;
		$this->view = $app['view'];
		$this->menus = [];
		$this->container = $app['config']['menu.container'];
		$this->parent = $app['config']['menu.parent'];
		$this->child = $app['config']['menu.child'];
	}

	public function getMenu()
	{
		return $this->menus;
	}

	public function registerMenu($menus, $group = null)
	{
		if (!is_null ($group)) {
			$this->mergeMenu($menus, $group);
		} else {
			$this->mergeMenu($menus, 'general');
		}

		return $this;
	}

	private function mergeMenu($menu, $group)
	{
		if (array_key_exists($group, $this->menus)) {
			$this->menus[$group] = array_merge($this->menus[$group], $menu);
		} else {
			$this->menus[$group] = $menu;
		}
	}

	public function render($group = null)
	{
		if (is_null($group)) {
			foreach ($this->menus as $group => $menu)
			{
				$view .= $this->resolveView($menu);
			}
		} else {
			$view = $this->resolveView($this->menus[$group]);
		}

		return $this->view->make($this->container, ['content' => $view])->render();
	}

	public function resolveView($arr_menu)
	{
		$result = '';

		foreach ($arr_menu as $menu => $value)
		{
			if (is_array($value)) {
				$child = $this->resolveView($value);
				$active = $this->isActive($child)?'active':'';
				$result .= $this->view->make($this->parent, ['active' => $active,'link' => $menu, 'child' => $child])->render();
			} else {
				$result .= $this->view->make($this->child, ['link' => $menu, 'url' => $value])->render();
			}
		}

		return $result;
	}

	public function isActive($child)
	{
		$path = $this->app['request']->path();

		return Str::contains($child, $path);
	}
}