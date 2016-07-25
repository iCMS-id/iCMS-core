<?php 

namespace ICMS\Console\Package;

use Illuminate\Console\Command;

class PackageInstallCommand extends Command {

	protected $signature = "package:install";

	protected $description = "List iCMS Package";

	public function handle()
	{
		$this->info("Gome");
	}
}