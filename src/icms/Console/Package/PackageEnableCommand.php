<?php 

namespace ICMS\Console\Package;

use Illuminate\Console\Command;

class PackageEnableCommand extends Command {

	protected $signature = "package:enable";

	protected $description = "Enable iCMS Package";

	public function handle()
	{
		$this->info("Gome");
	}
}