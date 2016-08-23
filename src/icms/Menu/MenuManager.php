<?php 

namespace ICMS\Menu;

use Illuminate\Support\Str;
use ICMS\Models\Menu;
use InvalidArgumentException;

class MenuManager {
	protected $app;
	protected $view;
	protected $menus;
	protected $mode = 'admin';
	protected $view_container;

	public function __construct($app)
	{
		$this->app = $app;
		$this->view = $app['view'];
		$this->view_container = $app['config']['icms.menu'];
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

	public function getViewContainer($container)
	{
		return $this->view_container[$this->mode][$container];
	}

	public function getMode()
	{
		return $this->mode;
	}

	public function setMode($mode)
	{
		if ($mode == 'admin' || $mode == 'web') {
			$this->mode = $mode;
		}

		return $this;
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
		$container = $this->getViewContainer('container');

		if (is_null($group)) {
			foreach ($this->menus as $group => $menu)
			{
				$view .= $this->resolveView($menu);
			}
		} elseif (array_key_exists($group, $this->menus)) {
			$view = $this->resolveView($this->menus[$group]);
		}

		return $this->view->make($container, ['content' => $view])->render();
	}

	public function resolveView(Menu $menus)
	{
		$result = '';
		$child = $this->getViewContainer('child');
		$parent = $this->getViewContainer('parent');

		foreach ($menus->getDescendants(1) as $menu)
		{
			if ($menu->isLeaf()) {

				if (!is_null($menu->route)) {

					try {
						$url = resolveRoute($menu->route);
					} catch (InvalidArgumentException $ex) {
						$url = '#';
					} finally {
						$result .= $this->view->make($child, ['link' => $menu->name, 'url' => $url])->render();
					}

				} elseif (!is_null($menu->url)) {

					if ($menu->type == 'external') {
						$result .= $this->view->make($child, ['link' => $menu->name, 'url' => $menu->url ])->render();
					} else {
						$result .= $this->view->make($child, ['link' => $menu->name, 'url' => url($menu->url)])->render();
					}

				} else {

					$result .= $this->view->make($child, ['link' => $menu->name, 'url' => '#'])->render();

				}

			} else {

				$child_data = $this->resolveView($menu);
				$result .= $this->view->make($parent, ['link' => $menu->name, 'child' => $child_data])->render();

			}
		}

		return $result;
	}
}