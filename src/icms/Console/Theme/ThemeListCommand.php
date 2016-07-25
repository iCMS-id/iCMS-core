<?php 

namespace ICMS\Console\Theme;

use Illuminate\Console\Command;

class ThemeListCommand extends Command {

	protected $signature = "theme:list";

	protected $description = "List iCMS Package";

	public function handle()
	{
		$this->info("Gome");
	}
}