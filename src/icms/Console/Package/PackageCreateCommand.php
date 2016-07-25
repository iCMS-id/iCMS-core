<?php 

namespace ICMS\Console\Package;

use Illuminate\Console\Command;

class PackageCreateCommand extends Command {

	protected $signature = 'package:create
                        {package_name : The ID of the user}
                        {--queue= : Whether the job should be queued}';

	protected $description = 'Create iCMS Package.';

	public function handle()
	{
// 		$userId = $this->argument('user');
// 		$queueName = $this->option('queue');
// 		$name = $this->ask('What is your name?');
// 		$password = $this->secret('What is the password?');
// 		if ($this->confirm('Do you wish to continue? [y|N]')) {
//     //
// }
// $name = $this->anticipate('What is your name?', ['Taylor', 'Dayle']);
// $name = $this->choice('What is your name?', ['Taylor', 'Dayle'], $default);
// $this->error('Something went wrong!');
// $this->line('Display this on the screen');
// $headers = ['Name', 'Email'];

// $users = App\User::all(['name', 'email'])->toArray();

// $this->table($headers, $users);
// $bar = $this->output->createProgressBar(count($users));

// foreach ($users as $user) {
//     $this->performTask($user);

//     $bar->advance();
// }

// $bar->finish();

		$this->info('Command package:create fire');
	}
}