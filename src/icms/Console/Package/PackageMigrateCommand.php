<?php 
namespace ICMS\Console\Package;

use Illuminate\Console\Command;
use Package;

class PackageMigrateCommand extends Command {
	protected $signature = 'package:migrate {package name}';
	protected $description = 'Package Migrate Command';

	public function fire()
	{
		$package = Package::getPackageByName($this->argument('package name'));

		if (is_null($package)) {
			$this->error('Package Name Not Found.');
			return;
		}

		$database_path = str_replace($this->laravel->basePath().'/', null, $package->path . '/database/migrations');

		$this->call('migrate', ['--path' => $database_path]);
	}
}