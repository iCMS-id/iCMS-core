<?php 

namespace ICMS\Console\Package;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\ConnectionResolverInterface as Resolver;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Package;

class PackageSeedCommand extends Command {
	protected $name = 'package:seed';
	protected $description = 'Seed database seeder';
	protected $resolver;
	protected $file;

	public function __construct(Resolver $resolver, $file)
	{
		parent::__construct();
		$this->resolver = $resolver;
		$this->file = $file;
	}

	public function fire()
	{
		$package = Package::getPackageByName($this->argument('package name'));

		if (is_null($package)) {
			$this->error('Package Name Not Found.');
			return;
		}

		Package::setEnvironmentPath($package->path);

		$this->resolver->setDefaultConnection($this->getDatabase());

		Model::unguarded(function () use ($package) {
			$this->getSeeder($package)->run();
		});
	}

	protected function getDatabase()
	{
		return $this->laravel['config']['database.default'];
	}

	protected function getSeeder($package)
	{
		$files = $this->file->glob($package->path . '/database/seeder/*');

		foreach ($files as $file) {
			$this->file->requireOnce($file);
		}

		$class = $this->laravel->make($this->input->getOption('class'));

		return $class->setContainer($this->laravel)->setCommand($this);
	}

	/**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['class', null, InputOption::VALUE_OPTIONAL, 'The class name of the root seeder', 'DatabaseSeeder'],
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