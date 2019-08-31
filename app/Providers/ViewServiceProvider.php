<?php
namespace App\Providers;

use \Illuminate\Support\Str;

use \Illuminate\Support\Facades\Route;

class ViewServiceProvider extends
	\Illuminate\View\ViewServiceProvider {

	/**
	 * @var bool
	 */
	public static $ignorableInConsole = true;
}
