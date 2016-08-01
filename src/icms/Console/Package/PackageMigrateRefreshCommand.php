<?php 

namespace ICMS\Console\Package;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Package;

class PackageMigrateRefreshCommand extends Command {
	protected $name = 'package:migrate:refresh';
	protected $description = 'Refresh migration package';

	public function fire()
	{
		$package = Package::getPackageByName($this->argument('package name'));
		Package::setEnvironmentPath($package->path);

		if (is_null($package)) {
			$this->error('Package Name Not Found.');
			return;
		}

		$this->call('package:migrate:reset', ['package name' => $package->name]);
		$this->call('package:migrate', ['package name' => $package->name, '--seed' => $this->input->getOption('seed')]);
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