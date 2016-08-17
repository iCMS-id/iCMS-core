<?php 

namespace ICMS\Menu;

use Illuminate\Support\Str;
use ICMS\Models\Menu;
use InvalidArgumentException;

class MenuManager {
	protected $app;
	protected $view;
	protected $menus;
	protected $container, $parent, $child;

	public function __construct($app)
	{
		$this->app = $app;
		$this->view = $app['view'];
		$this->container = $app['config']['icms.menu_container.container'];
		$this->parent = $app['config']['icms.menu_container.parent'];
		$this->child = $app['config']['icms.menu_container.child'];
		$this->readModel();
	}

	protected function readModel()
	{
		$this->menus = [];
		$menus = Menu::roots()->get();

		foreach ($menus as $menu) {
			$this->menus[$menu->name] = $menu;
		}
	}

	public function getMenu()
	{
		return $this->menus;
	}

	public function registerMenu($menus, $group = 'admin')
	{
		$menu = Menu::roots()->where('name', $group)->first();

		if ($menu) {
			dd($menus);
			// $menu->makeTree($menus);
		}

		$this->readModel();

		return $this;
	}

	public function render($group = null)
	{
		$view = '';

		if (is_null($group)) {
			foreach ($this->menus as $group => $menu)
			{
				$view .= $this->resolveView($menu);
			}
		} elseif (array_key_exists($group, $this->menus)) {
			$view = $this->resolveView($this->menus[$group]);
		}

		return $this->view->make($this->container, ['content' => $view])->render();
	}

	public function resolveView(Menu $menus)
	{
		$result = '';

		foreach ($menus->getDescendants(1) as $menu)
		{
			if ($menu->isLeaf()) {

				$options = $menu->options;

				if (array_key_exists('route', $options)) {

					try {
						$url = resolveRoute($menu->route);
					} catch (InvalidArgumentException $ex) {
						$url = '#';
					} finally {
						$result .= $this->view->make($this->child, ['link' => $menu->name, 'url' => $url])->render();
					}

				} elseif (array_key_exists('url', $options)) {

					if ($menu->type == 'external') {
						$result .= $this->view->make($this->child, ['link' => $menu->name, 'url' => $menu->url ])->render();
					} else {
						$result .= $this->view->make($this->child, ['link' => $menu->name, 'url' => url($menu->url)])->render();
					}

				} else {

					$result .= $this->view->make($this->child, ['link' => $menu->name, 'url' => '#'])->render();

				}

			} else {

				$child = $this->resolveView($menu);
				$active = false;//$this->isActive($child)?'active':'';
				$result .= $this->view->make($this->parent, ['active' => $active, 'link' => $menu->name, 'child' => $child])->render();

			}
		}

		return $result;
	}

	public function isActive($child)
	{
		$path = $this->app['request']->path();

		return Str::contains($child, $path . "\"");
	}
}