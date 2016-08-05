<?php 
namespace Package\DummyPackage\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DummyListener
{
	/**
	 * Create the event listener.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  user.created  $event
	 * @return void
	 */
	public function handle($event)
	{
		//
	}
}