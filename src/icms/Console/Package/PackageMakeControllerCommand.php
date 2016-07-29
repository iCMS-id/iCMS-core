<?php 
namespace ICMS\Console\Package;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Package;

class PackageMakeControllerCommand extends Command {
	protected $signature = "package:make:controller {package name} {controller name}";
	protected $description = "Make Controller iCMS Package";
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

		$controller_path = $package->path . '/Http/Controllers';
		$controller_name = Str::studly($this->argument('controller name'));

		$namespace = Str::studly($vendor) . '\\' . Str::studly($paket);

		if ($this->file->exists($controller_path . '/' . $controller_name . '.php')) {
			$this->info('Controller already exists');
			return;
		}

		$controller_content = $this->file->get(__DIR__.'/stubs/DummyController.php');
		$controller_content = str_replace('DummyController', $controller_name, $controller_content);
		$controller_content = str_replace('DummyPackage', $namespace, $controller_content);

		$this->file->put($controller_path . '/' . $controller_name . '.php', $controller_content);
		$this->info('Controller create success.');
	}
}