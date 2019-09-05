<?php
namespace App\Providers;

use \Illuminate\Support\Str;
use \Illuminate\Support\Facades\Route;

use \App\Custom\Router;

class RoutingServiceProvider extends
	\Illuminate\Routing\RoutingServiceProvider {

	/**
	 * @var bool
	 */
	public static $ignorableInConsole = true;

	/**
	 * Register the router instance.
	 *
	 * @return void
	 */
	protected final function registerRouter() {
		$this->app->singleton('router', function ($app) {
			return new Router($app['events'], $app);
		});
	}

}
