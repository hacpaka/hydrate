<?php
namespace App\Console;

use \Illuminate\Support\Arr;
use \Illuminate\Support\Str;

use \Illuminate\Console\Application;
use \Illuminate\Console\Command;
use \Illuminate\Console\Scheduling\Schedule;

use \Symfony\Component\Finder\Finder;

use \ReflectionClass;
use \ReflectionException;

class Kernel
	extends \Illuminate\Foundation\Console\Kernel {

	/**
	 * Define the application's command schedule.
	 *
	 * @param Schedule $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule) {

		/*
		 * The schedule is empty.
		 *
		 * The example:
		 * $schedule->command('commandname')->hourly();
		*/
	}

	/**
	 * Register the commands for the application.
	 * @return void
	 * @throws ReflectionException
	 */
	protected function commands() {
		$this->load(__DIR__ . '/Commands');
	}

	/**
	 * Register all of the commands in the given directory.
	 *
	 * @param array|string $paths
	 * @return void
	 * @throws ReflectionException
	 */
	protected function load($paths) {
		$paths = array_unique(Arr::wrap($paths));

		$paths = array_filter($paths, function ($path) {
			return is_dir($path);
		});

		if (empty($paths)) {
			return;
		}

		$namespace = defined('UNIT_NAMESPACE') ? UNIT_NAMESPACE : $this->app->getNamespace();
		foreach ((new Finder)->in($paths)->files() as $command) {

			$command = $namespace . str_replace(
				['/', '.php'],
				['\\', ''],
				Str::after($command->getPathname(), realpath(defined('UNIT_PATH') ? (UNIT_PATH . DIRECTORY_SEPARATOR . 'app'): app_path()) . DIRECTORY_SEPARATOR)
			);

			if (is_subclass_of($command, Command::class) &&
				!(new ReflectionClass($command))->isAbstract()) {
				Application::starting(function ($artisan) use ($command) {
					$artisan->resolve($command);
				});
			}
		}
	}
}
