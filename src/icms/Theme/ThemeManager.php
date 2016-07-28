<?php 

namespace ICMS\Theme;

use FilesystemIterator;
use File;
use Symfony\Component\Process\Process;

class ThemeManager {
	protected $theme_path;
	protected $public_path;

	protected $command = 'ln -s ../themes/default/assets/* .';

	public function __construct($app)
	{
		$this->public_path = $app['path.public'];
		$this->theme_path = $app['path.base'] . '/themes';
	}

	public function getThemes()
	{
		$theme = [];
		$files = glob($this->theme_path . '/*');

		foreach ($files as $file)
		{
			if (File::isDirectory($file) && File::exists($file . '/theme.json')) {
				$meta = $this->readJson($file . '/theme.json');
				$theme[] = $meta;
			}
		}
		
		return $theme;
	}

	public function getNames()
	{
		$names = [];
		$themes = $this->getThemes();

		foreach ($themes as $theme)
		{
			$names[] = $theme['slug'];
		}

		return $names;
	}

	public function getCurrentTheme()
	{
		$themes = $this->theme_path . '/themes.json';
		$json = $this->readJson($themes);

		return $json['active'];
	}

	public function getMeta($theme_name = null)
	{
		if (is_null($theme_name)) {
			$theme_name = $this->getCurrentTheme();
		}

		$path = $this->theme_path . '/' . $theme_name . '/theme.json';

		return $this->readJson($path);
	}

	public function readJson($path)
	{
		return json_decode(File::get($path), true);
	}

	public function writeJson($path, $content)
	{
		return File::put($path, json_encode($content));
	}

	public function createTheme($name, $slug, $desc, $author, $email)
	{
		//
	}

	public function createLink($theme_name)
	{
		$meta = $this->getMeta($theme_name);
		$public = $this->public_path;
		$path = $this->theme_path . '/' . $theme_name . '/';
		$publish = $meta['publish'];

		foreach ($publish as $keys => $publis)
		{
			if ($publis == 'vendors') continue;			//Should throw new Exception

			$process = new Process("ln -s " . $path . $keys . " " . $publis, $public);
			$process->run();
		}

		return true;
	}

	public function removeLink($theme_name)
	{
		$meta = $this->getMeta($theme_name);
		$path = $this->public_path . '/';
		$publish = $meta['publish'];

		foreach ($publish as $keys => $publis)
		{
			if (File::isDirectory($path . $publis)) {
				File::delete($path . $publis);
			}
		}

		return true;
	}

	public function activeTheme($theme_name)
	{
		$themes = $this->theme_path . '/themes.json';
		$names = $this->getNames();

		if (in_array($theme_name, $names) && ! is_null($theme_name)) {
			$this->removeLink($this->getCurrentTheme());
			$this->createLink($theme_name);
			$this->writeJson($themes, ['active' => $theme_name]);
		}

		return false;
	}

	public function importsTheme($themes_name = null)
	{
		$scripts = $this->importsScripts($themes_name);
		$styles = $this->importsStyles($themes_name);

		return $styles . "\n" . $scripts;
	}

	public function importsScripts($themes_name = null)
	{
		$meta = $this->getMeta($themes_name);
		$scripts = $meta['import-js'];
		$txt = "";

		foreach ($scripts as $script)
		{
			$txt .= "<script src=\"" . asset($script) . "\" type=\"text/javascript\"></script>\n";
		}

		return $txt;
	}

	public function importsStyles($themes_name = null)
	{
		$meta = $this->getMeta($themes_name);
		$styles = $meta['import-css'];
		$txt = "";

		foreach ($styles as $style)
		{
			$txt .= "<link rel=\"stylesheet\" type=\"text/css\"  href=\"" . asset($style) . "\">\n";
		}

		return $txt;
	}
}