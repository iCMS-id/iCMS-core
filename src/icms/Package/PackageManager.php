<?php 

namespace ICMS\Package;

class PackageManager {
	protected $app;

	public function __construct($app)
	{
		$this->app = $app;
	}

	public function getAllPackages($active)
	{
		return 0;
	}

	public function handleUrl($uri)
	{
		//
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
		//
	}
}