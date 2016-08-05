<?php 
namespace ICMS\Console\Package;

use Illuminate\Console\Command;
use Illuminate\Database\Migrations\Migrator;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Package;

class PackageMigrateCommand extends Command {
	protected $name = 'package:migrate';
	protected $description = 'Package Migrate Command';
	protected $migrator;

	public function __construct(Migrator $migrator)
	{
		parent::__construct();
		$this->migrator = $migrator;
	}

	public function fire()
	{
		$package = Package::getPackage($this->argument('package name'));

		if (is_null($package)) {
			$this->error('Package Name Not Found.');
			return;
		}

		Package::setEnvironmentPath($package->path);

		$database_path = str_replace($this->laravel->basePath().'/', null, $package->path . '/database/migrations');
		$migrations = $this->laravel['files']->glob($package->path . '/database/migrations/*');

		foreach ($migrations as $key => $file) {
			$migrations[$key] = $this->laravel['files']->name($file);
		}

		sort($migrations);
		$this->migrator->requireFiles($database_path, $migrations);

		foreach ($migrations as $migration) {
			$instance = $this->migrator->resolve($migration);
			$instance->up();

			$this->output->writeln("<info>Migrated:</info> $migration");
		}

		if ($this->input->getOption('seed')) {
			$this->call('package:seed', ['package name' => $package->name]);
		}
	}
	
	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['seed', null, InputOption::VALUE_NONE, 'Indicates if the seed task should be re-run.'],
		];
	}

	/**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['package name', InputArgument::REQUIRED, 'The name of package'],
        ];
    }
}