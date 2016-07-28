<?php 
namespace ICMS\Package;

class PackageAsset {
	protected $package;
	protected $app;
	protected $file;

	public function __construct($app, $package)
	{
		$this->app = $app;
		$this->file = $app['files'];
		$this->package = $package;
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

	public function resolveAsset($path)
	{
		return asset('vendor/' . $this->package->name . '/' . $path);
	}

	public function publishAsset($package = null)
	{
		$file = $this->file;
		$dest = $this->app['path.public'] . '/vendor/' . $package->name;
		$src = $package->assets;

		if (! $file->exists($dest)) {
			$file->makeDirectory($dest, 0766, true, true);
		}

		foreach ($src as $sr)
		{
			$source = $package->path . '/' . $sr;

			$this->copyAssets($source, $dest);
		}

		return true;
	}

	public function copyAssets($source, $destination)
	{
		$file = $this->file;

		return $file->copyDirectory($source, $destination);;
	}
}