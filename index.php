<?php
/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */
define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels great to relax.
|
*/

require __DIR__ . '/vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Validate the unit root directory
|--------------------------------------------------------------------------
|
| The unit root directory has to be a subfolder
| of the application base directory.
|
*/
try {
	if (!defined('UNIT_PATH')) {
		throw new \Exception('Unit path is undefined!');
	}

	/**
	 * To guarantee the mps-feature properly work,
	 * the unit base directory has to be a subfolder
	 * of the application units folder.
	 */
	define('UNIT_NAME', call_user_func(function (){ if (!preg_match('/^' . preg_quote(__DIR__ . DIRECTORY_SEPARATOR . 'units'
		. DIRECTORY_SEPARATOR, '/') . '(.*)$/', rtrim(UNIT_PATH, DIRECTORY_SEPARATOR), $Matches)){
			throw new \Exception('Unit path is not a subfolder of the main directory!'); }

		/**
		 * Actually, the unit name it's the unit subfolder
		 * with some limitation: only Latin letters,
		 * underscore or dash characters.
		 */
		if (!preg_match('/^[A-Z0-9_-]/i', $Matches[1])){
			throw new \Exception(sprintf('Invalid unit name: %s!', $Matches[1]));
		}

		return $Matches[1];
	}));
}catch (\Throwable $Exception){
	trigger_error($Exception->getMessage(), E_USER_ERROR);
}

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let us turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight our users.
|
*/

$app = require_once __DIR__ . '/bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
	$request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
