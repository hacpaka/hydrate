<?php
namespace App\Providers;

use \Illuminate\Support\Str;

use \Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use \Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider {

	/**
	 * @var bool
	 */
	public static $ignoreConsole = true;

	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @return void
	 */
	public function boot() {
		$this->namespace = implode('\\', ['Units',
			ucfirst(Str::camel(UNIT_NAME)), 'Controllers']);

		parent::boot();
	}

	/**
	 * Define the routes for the application.
	 *
	 * @return void
	 */
	public function map() {
		$this->mapApiRoutes();

		$this->mapWebRoutes();
	}

	/**
	 * Define the "web" routes for the application.
	 * These routes all receive session state, CSRF protection, etc.
	 *
	 * @return void
	 */
	protected function mapWebRoutes() {
		if (file_exists($file = unit_path('routes/web.php'))) {

			Route::middleware('web')
				->namespace($this->namespace)
				->group($file);
		}
	}

	/**
	 * Define the "api" routes for the application.
	 * These routes are typically stateless.
	 *
	 * @return void
	 */
	protected function mapApiRoutes() {
		if (file_exists($file = unit_path('routes/api.php'))) {
			Route::prefix('api')
				->middleware('api')
				->namespace($this->namespace)
				->group($file);
		}
	}
}
