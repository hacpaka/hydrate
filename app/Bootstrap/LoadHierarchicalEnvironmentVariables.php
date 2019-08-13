<?php
namespace App\Bootstrap;

use \Illuminate\Contracts\Foundation\Application;
use \Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use \Illuminate\Support\Env;

use \App\Custom\HierarchicalDotenv;

class LoadHierarchicalEnvironmentVariables
	extends LoadEnvironmentVariables {

	/**
	 * Create a Dotenv instance.
	 *
	 * @param Application $app
	 * @return HierarchicalDotenv
	 */
	protected final function createDotenv($app) {
		return HierarchicalDotenv::create([
				$app->environmentPath(),
				$app->unitEnvironmentPath()
			], $app->environmentFile(),
			Env::getFactory()
		);
	}
}
