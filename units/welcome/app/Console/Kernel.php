<?php
namespace Units\Dashboard\Console;

use \Illuminate\Console\Scheduling\Schedule;
use \ReflectionException;

class Kernel
	extends \App\Console\Kernel {

	/**
	 * Register the commands for the application.
	 *
	 * @return void
	 * @throws ReflectionException
	 */
	protected function commands() {
		$this->load(__DIR__ . '/Commands');
		parent::commands();
	}
}
