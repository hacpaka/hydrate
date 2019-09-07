<?php
namespace App\Custom\Abstractions;

use \Illuminate\Http\Request;
use \Illuminate\Http\Response;
use \Illuminate\Routing\Pipeline;

use \Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Log;
use \Illuminate\Support\Facades\Facade;

class AKernel
	extends \Illuminate\Foundation\Http\Kernel {

	/**
	 * Send the given request through the middleware / router.
	 *
	 * @param Request $Request
	 * @return Response
	 */
	protected function sendRequestThroughRouter($Request) {
		$this->app->instance('request', $Request);

		Facade::clearResolvedInstance('request');

		$this->bootstrap();

		if (config('app.debug') && config('database.debug')) {
			DB::enableQueryLog();
		}

		/**
		 * @var Response
		 */
		$Response =  (new Pipeline($this->app))
			->send($Request)
			->through($this->app->shouldSkipMiddleware() ? [] : $this->middleware)
			->then($this->dispatchToRouter());

		if (config('app.debug') && config('database.debug')) {
			Log::info(DB::getQueryLog());
		}

		return  $Response;
	}

}
