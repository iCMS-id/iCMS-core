<?php 

namespace ICMS\Console\Package;

use Illuminate\Console\Command;

class PackageDisableCommand extends Command {

	protected $signature = "package:disable";

	protected $description = "List iCMS Package";

	public function handle()
	{
		$this->info("Gome");
	}
}