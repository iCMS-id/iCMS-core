<?php 
namespace ICMS\Console\Package;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Package;

class PackageMakeModelCommand extends Command {
	protected $signature = 'package:make:model {package name} {model name}';
	protected $description = 'Create package model.';
	protected $file;

	public function __construct($file)
	{
		parent::__construct();
		$this->file = $file;
	}

	public function fire()
	{
		$package = Package::getPackageByName($this->argument('package name'));

		if (is_null($package)) {
			$this->error('package not found.');
			return;
		}

		list($vendor, $paket) = explode('/', $package->name);

		$model_path = $package->path . '/Models';
		$model_name = Str::studly($this->argument('model name'));

		$namespace = Str::studly($vendor) . '\\' . Str::studly($paket);

		if ($this->file->exists($model_path . '/' . $model_name . '.php')) {
			$this->error('Model already exists.');
			return;
		}

		$model_content = $this->file->get(__DIR__.'/stubs/DummyModel.php');
		$model_content = str_replace('DummyModel', $model_name, $model_content);
		$model_content = str_replace('DummyPackage', $namespace, $model_content);

		$this->file->put($model_path . '/' . $model_name . '.php', $model_content);
		$this->info('Model create success.');
	}
}