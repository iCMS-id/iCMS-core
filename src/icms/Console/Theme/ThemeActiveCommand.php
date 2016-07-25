<?php 

namespace ICMS\Console\Theme;

use Illuminate\Console\Command;

class ThemeActiveCommand extends Command {

	protected $signature = "theme:active";

	protected $description = "List iCMS Package";

	public function handle()
	{
		$this->info("Gome");
	}
}