<?php 

namespace ICMS\Package;

use InvalidArgumentException;

class PackageView {
	protected $app;
	protected $package;

	public function __construct($app, $package)
	{
		$this->app = $app;
		$this->package = $package;
	}

	public function makeView($view, $data = [])
	{
		$is_admin = $this->isAdminPath();

		if (! is_null($path = $this->normalizePath($view))) {
			$data = $this->app['view']->file($path, $data)->render();

			if ($is_admin) {
				$template = $this->app['view']->make($this->app['config']['icms.template.admin']);
			} else {
				$template = $this->app['view']->make($this->app['config']['icms.template.web']);
			}

			$template->getFactory()->inject('content', $data);

			return $template;
		}

		throw new InvalidArgumentException("View [$view] not found.");
	}

	public function normalizePath($view)
	{
		$view = str_replace('/', '.', $view);
		$file = $this->app['files'];
		$paths = $this->package->views;

		foreach ($paths as $path)
		{
			$resolve = $this->resolveViewPath($path, $view);
			if ($file->exists($resolve)) {
				return $resolve;
			}
		}

		return null;
	}

	public function resolveViewPath($path, $view)
	{
		return $this->package->path . '/' . $path . '/' . $view . '.blade.php';
	}

	public function isAdminPath()
	{
		return preg_match("/\/admin\/apps\//", $this->app['request']->path());
	}

	public function setPackage($package)
	{
		$this->package = $package;
		return $this;
	}

	public function getPackage()
	{
		return $this->package;
	}
}