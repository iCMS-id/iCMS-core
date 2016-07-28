<?php 

namespace ICMS\Console\Widget;

use Illuminate\Console\Command;

class WidgetCreateCommand extends Command {
	
	protected $signature = "package:widget:create";

	protected $description = "Create Package Widget";

	public function handle()
	{
		$this->info("Gome");
	}
}