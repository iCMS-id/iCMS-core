<?php 

namespace ICMS\Console\Theme;

use Illuminate\Console\Command;
use Theme;

class ThemeCreateCommand extends Command {

	protected $signature = "theme:create";

	protected $description = "Create iCMS Themes";

	public function handle()
	{
		do {
			$data = $this->getData();
		} while (! $this->confirm("Are you sure to create theme?", true));

		Theme::createTheme($data['name'],
			$data['slug'],
			$data['desc'],
			$data['author'],
			$data['email']);

		$this->info("Create theme success.");
	}

	public function getData()
	{
		$theme = [];
		$theme['name'] = $this->ask('Theme name ');
		$theme['slug'] = $this->ask('Theme slug ', str_slug($theme['name']));
		$theme['desc'] = $this->ask('Description for this theme', 'This description for theme');
		$theme['author'] = $this->ask('Author name', 'Any');
		$theme['email'] = $this->ask('Author email', 'Any');

		return $theme;
	}
}