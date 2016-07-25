<?php 

namespace ICMS\Console\Package;

use Illuminate\Console\Command;

class PackageListCommand extends Command {

	protected $signature = "package:list";

	protected $description = "List iCMS Package";

	public function handle()
	{
		$this->info("Gome");
	}
}