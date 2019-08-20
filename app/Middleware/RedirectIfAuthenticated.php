<?php
namespace App\Middleware;

use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Auth;

use \Closure;

class RedirectIfAuthenticated {

	/**
	 * Handle an incoming request.
	 *
	 * @param Request $Request
	 * @param Closure $Next
	 * @param string|null $Guard
	 * @return mixed
	 */
	public function handle($Request, Closure $Next, $Guard = null) {
		if (Auth::guard($Guard)->check()) {
			return redirect('/home');
		}

		return $Next($Request);
	}
}
