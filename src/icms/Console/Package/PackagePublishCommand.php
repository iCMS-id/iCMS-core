<?php 

namespace ICMS\Console\Package;

use Illuminate\Console\Command;
use Package;

class PackagePublishCommand extends Command {

	protected $signature = "package:publish";

	protected $description = "Publish Package Asset";

	public function handle()
	{
		Package::publishAsset();
		$this->info("Assets published.");
	}
}