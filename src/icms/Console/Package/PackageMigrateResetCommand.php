<?php 

namespace ICMS\Console\Package;

use Illuminate\Console\Command;
use Illuminate\Database\Migrations\Migrator;
use Package;

class PackageMigrateResetCommand extends Command {
	protected $signature = 'package:migrate:reset {package name}';
	protected $description = 'Reset all migration package';
	protected $migrator;

	public function __construct(Migrator $migrator)
	{
		parent::__construct();
		$this->migrator = $migrator;
	}

	public function fire()
	{
		$package = Package::getPackageByName($this->argument('package name'));
		Package::setEnvironmentPath($package->path);
		
		$database_path = str_replace($this->laravel->basePath().'/', null, $package->path . '/database/migrations');
		$migration_files = $this->laravel['files']->glob($package->path . '/database/migrations/*');

		foreach ($migration_files as $key => $file) {
			$migration_files[$key] = $this->laravel['files']->name($file);
		}

		$migrations = $this->migrator->getRepository()->getRan();
		
		foreach ($migrations as $migration) {
			if (in_array($migration, $migration_files)) {
				$this->migrator->requireFiles($database_path, [$migration]);

				$instance = $this->migrator->resolve($migration);
				$instance->down();

				$this->migrator->getRepository()->delete((object) ['migration' => $migration]);

				$this->output->writeln("<info>Rolled back:</info> $migration");
			}
		}
	}
}