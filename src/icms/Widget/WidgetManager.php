<?php 

namespace ICMS\Widget;

class WidgetManager {
	protected $app;

	public function __construct($app) {
		$this->app = $app;
	}

	public function createWidget($package_name, $widget_name)
	{
		//
	}

	public function generateWidget($view)
	{
		$view = $this->app['view']->make($view);

		return $view->render();
	}
}