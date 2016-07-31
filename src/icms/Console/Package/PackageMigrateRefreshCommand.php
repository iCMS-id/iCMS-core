<?php 

namespace ICMS\Console\Package;

use Illuminate\Console\Command;
use Package;

class PackageMigrateRefreshCommand extends Command {
	protected $signature = 'package:migrate:refresh {package name}';
	protected $description = 'Refresh migration package';

	public function fire()
	{
		$package = Package::getPackageByName($this->argument('package name'));
		Package::setEnvironmentPath($package->path);

		if (is_null($package)) {
			$this->error('Package Name Not Found.');
			return;
		}

		$this->call('package:migrate:reset', ['package name' => $package->name]);
		$this->call('package:migrate', ['package name' => $package->name]);
	}
}