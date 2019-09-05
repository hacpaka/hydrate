<?php
namespace App\Custom;

class Router
	extends \Illuminate\Routing\Router {

	/**
	 * Register the typical authentication routes for an application.
	 *
	 * @param array $options
	 * @return void
	 */
	public function auth(array $options = []) {
		// Authentication Routes...
		$this->get('login', '\App\Controllers\Auth\LoginController@showLoginForm')->name('login');
		$this->post('login', '\App\Controllers\Auth\LoginController@login');
		$this->post('logout', '\App\Controllers\Auth\LoginController@logout')->name('logout');

		// Registration Routes...
		if ($options['register'] ?? true) {
			$this->get('register', '\App\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
			$this->post('register', '\App\Controllers\Auth\RegisterController@register');
		}

		// Password Reset Routes...
		if ($options['reset'] ?? true) {
			$this->resetPassword();
		}

		// Password Confirmation Routes...
		if ($options['confirm'] ??
			class_exists($this->prependGroupNamespace('\App\Controllers\Auth\ConfirmPasswordController'))) {

			$this->confirmPassword();
		}

		// Email Verification Routes...
		if ($options['verify'] ?? false) {
			$this->emailVerification();
		}
	}
}
