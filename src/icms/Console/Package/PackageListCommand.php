<?php 

namespace ICMS\Console\Package;

use Illuminate\Console\Command;
use Package;

class PackageListCommand extends Command {

	protected $signature = "package:list";

	protected $description = "List iCMS Package";

	public function handle()
	{
		$header = ["X", "Name", "Slug", "Description"];
		$packages = Package::getAllPackages();
		
		$this->info("Gome");
	}
}