<?php 

namespace ICMS\Console\Theme;

use Illuminate\Console\Command;

class ThemeCreateCommand extends Command {

	protected $signature = "theme:create";

	protected $description = "List iCMS Package";

	public function handle()
	{
		$this->info("Gome");
	}
}