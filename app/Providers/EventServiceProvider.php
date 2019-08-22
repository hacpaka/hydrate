<?php
namespace App\Providers;

use \Illuminate\Support\Facades\Event;
use \Illuminate\Support\Facades\Config;

class EventServiceProvider
	extends \Illuminate\Foundation\Support\Providers\EventServiceProvider {

	/**
	 * Bootstrap any application services.
	 */
	public function boot() {
		$this->listen = array_merge($this->listen,
			Config::get('events'));

		parent::boot();
	}
}
