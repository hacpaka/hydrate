<?php
namespace Units\Welcome\Controllers;

use \Illuminate\Routing\Controller;

use \Illuminate\Foundation\Bus\DispatchesJobs;
use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use \Illuminate\Foundation\Validation\ValidatesRequests;

use \Illuminate\View\View;

class WelcomeController extends Controller {
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	/**
	 * @return View
	 */
	public final function main(){
		return view('welcom.blade.php');
	}
}

