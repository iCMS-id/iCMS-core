<?php 

namespace ICMS\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		Package\PackageCreateCommand::class,
		Package\PackageDisableCommand::class,
		Package\PackageEnableCommand::class,
		Package\PackageInstallCommand::class,
		Package\PackageListCommand::class,
		Package\PackagePublishCommand::class,
		Theme\ThemeActiveCommand::class,
		Theme\ThemeCreateCommand::class,
		Theme\ThemeListCommand::class,
		// Widget\WidgetCreateCommand::class,
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
		// $schedule->command('inspire')
		//          ->hourly();
	}
}
