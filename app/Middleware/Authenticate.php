<?php
namespace App\Middleware;

class Authenticate
	extends \Illuminate\Auth\Middleware\Authenticate {

	/**
	 * Get the path the user should be redirected to when they are not authenticated.
	 *
	 * @param Request $request
	 * @return string
	 */
	protected function redirectTo($request) {
		if (!$request->expectsJson()) {
			return route('login');
		}
	}
}
