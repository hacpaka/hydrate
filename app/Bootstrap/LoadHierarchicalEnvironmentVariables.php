<?php
namespace App\Bootstrap;

use \Dotenv\Dotenv;
use \Dotenv\Exception\InvalidPathException;

use \Illuminate\Contracts\Foundation\Application;
use \Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;

class LoadHierarchicalEnvironmentVariables
	extends LoadEnvironmentVariables {

	/**
	 * Bootstrap the given application.
	 *
	 * @param Application $App
	 * @return void
	 */
	public function bootstrap(Application $App): void {
		if ($App->configurationIsCached()) {
			return;
		}

		if (UNIT_PATH != base_path()) {
			(new Dotenv(base_path(), env('APP_ENV', $App->environmentFile())))->load();
		}

		$this->checkForSpecificEnvironmentFile($App);
		(new Dotenv($App->environmentPath(), $App->environmentFile()))->overload();
	}
}
