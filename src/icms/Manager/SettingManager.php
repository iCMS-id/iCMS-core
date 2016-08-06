<?php 
namespace ICMS\Manager;

use ICMS\Models\Setting;

class SettingManager {
	protected $app;

	public function __construct($app)
	{
		$this->app = $app;
	}

	public function get($key, $default = null)
	{
		return 'a;';
	}

	public function set($key, $value)
	{
		return $this;
	}
}