<?php
namespace App\Custom;

use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;

use \Illuminate\Support\Collection;
use \Illuminate\Support\Str;

use \Illuminate\Filesystem\Filesystem;
use \Illuminate\Foundation\Application;
use \Illuminate\Foundation\PackageManifest;
use \Illuminate\Foundation\ProviderRepository;

use \Illuminate\Events\EventServiceProvider;
use \Illuminate\Log\LogServiceProvider;

use \App\Providers\RoutingServiceProvider;
use \Facade\Ignition\IgnitionServiceProvider;

use \Exception;

class Standard extends Application {

	/**
	 * @var array
	 */
	protected $ignorableInConsoleList = [
		IgnitionServiceProvider::class,
	];

	/**
	 * Register all of the configured providers.
	 */
	public final function registerConfiguredProviders() {
		$providers = Collection::make($this->config['app.providers'])->filter(function ($class) {
			return !app()->runningInConsole() || !property_exists($class, 'ignorableInConsole') || !$class::$ignorableInConsole;
		})->partition(function ($provider) {
			return Str::startsWith($provider, 'Illuminate\\');
		});

		$providers->splice(1, 0, [
			array_filter($this->make(PackageManifest::class)->providers(), function (string $class) {
				return !app()->runningInConsole() || !in_array($class, $this->ignorableInConsoleList);
			})
		]);

		(new ProviderRepository($this, new Filesystem, $this->getCachedServicesPath()))
			->load($providers->collapse()->toArray());
	}

	/**
	 * Register all of the base service providers.
	 */
	protected function registerBaseServiceProviders() {
		$this->register(new EventServiceProvider($this));
		$this->register(new LogServiceProvider($this));
		$this->register(new RoutingServiceProvider($this));
	}

}
