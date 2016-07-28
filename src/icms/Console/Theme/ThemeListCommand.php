<?php 

namespace ICMS\Console\Theme;

use Illuminate\Console\Command;
use Theme;

class ThemeListCommand extends Command {

	protected $signature = "theme:list";

	protected $description = "List iCMS Theme";

	public function handle()
	{
		$data = [];
		$themes = Theme::getThemes();
		$headers = ["Slug", "Name", "Description"];

		foreach ($themes as $theme)
		{
			$data[] = [$theme['slug'], $theme['name'], $theme['description']];
		}

		$this->table($headers, $data);
	}
}