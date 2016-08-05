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

	public function publishAsset()
	{
		$file = $this->file;
		$dest = $this->app['path.public'] . '/vendor/' . $this->package->name;
		$src = $this->package->assets;

		if (! $file->exists($dest)) {
			$file->makeDirectory($dest, 0766, true, true);
		}

		foreach ($src as $sr)
		{
			$source = $this->package->path . '/' . $sr;

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