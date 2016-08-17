<?php 

namespace ICMS\Console\Package;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Package;

class PackagePublishCommand extends Command {

	protected $name = "package:publish";
	protected $description = "Publish Package Asset and Menu";

	public function handle()
	{
		$package_name = $this->argument('package name');

		Package::publishAsset($package_name);
		Package::publishMenu($package_name);

		$this->info("Assets and menu published.");
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['package name', InputArgument::OPTIONAL, 'The name of package'],
		];
	}
}