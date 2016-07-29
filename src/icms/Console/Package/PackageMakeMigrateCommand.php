<?php 

namespace ICMS\Console\Package;

use Illuminate\Console\Command;
use Package;

class PackageMakeMigrateCommand extends Command {
	protected $signature = "package:make:migration {package name} {migrate name}";
	protected $description = "Make Migration iCMS Package";

	public function fire()
	{
		$package = Package::getPackageByName($this->argument('package name'));
		$migrate = $this->argument('migrate name');

		if (is_null($package)) {
			$this->error('Package Name Not Found.');
			return;
		}

		$database_path = str_replace($this->laravel->basePath().'/', null, $package->path . '/database/migrations');
		$this->call('make:migration', [
			'name' => $migrate, 
			'--path' => $database_path,
			]);
	}
}