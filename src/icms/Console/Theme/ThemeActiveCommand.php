<?php 

namespace ICMS\Console\Theme;

use Illuminate\Console\Command;
use Theme;

class ThemeActiveCommand extends Command {

	protected $signature = "theme:active {theme_name}";

	protected $description = "Active theme";

	public function handle()
	{
		$theme_name = $this->argument('theme_name');

		Theme::activeTheme($theme_name);

		$this->info("Theme " . $theme_name . " has been activated.");
	}
}