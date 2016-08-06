<?php 
namespace ICMS\Manager;

use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use ICMS\Models\Setting;

class SettingManager {
	protected $app;

	public function __construct($app)
	{
		$this->app = $app;
	}

	public function get($key, $default = null)
	{
		$solved = $this->getPrefix($key);

		if (! is_null($solved['prefix'])) {
			$setting = Setting::where('prefix', $solved['prefix'])->get();

			if ($setting->count() > 0) {
				$settings = $setting->first()->settings;

				$value = Arr::get($settings, $solved['key'], $default);

				return $value;
			}
		}

		return $default;
	}

	public function set($key, $value)
	{
		$solved = $this->getPrefix($key);

		if (! is_null($solved['prefix'])) {
			$settings = Setting::where('prefix', $solved['prefix'])->get();

			if ($settings->count() > 0) {
				$setting = $settings->first();
				$data = $setting->settings;

				$this->setValue($solved['key'], $value, $data);

				$setting->settings = $data;
				$setting->save();
			} else {
				$setting = new Setting;
				$setting->prefix = $solved['prefix'];
				$data = [];

				$this->setValue($solved['key'], $value, $data);

				$setting->settings = $data;
				$setting->save();
			}
		}

		return $this;
	}

	protected function setValue($key, $value, &$arr)
	{
		if (is_array($key)) {
			foreach ($key as $innerKey => $innerValue) {
				Arr::set($arr, $innerKey, $innerValue);
			}
		} else {
			Arr::set($arr, $key, $value);
		}
	}

	protected function getPrefix($key)
	{
		$prefix = null;

		if (Str::contains($key, '::')) {
			list($prefix, $key) = explode('::', $key);
		}

		return ['prefix' => $prefix, 'key' => $key];
	}
}