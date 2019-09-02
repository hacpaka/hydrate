<?php
namespace App\Custom;

use \Illuminate\Support\Collection;
use \Illuminate\Support\Str;

use \Illuminate\Filesystem\Filesystem;
use \Illuminate\Foundation\Application;
use \Illuminate\Foundation\PackageManifest;
use \Illuminate\Foundation\ProviderRepository;

use \Facade\Ignition\IgnitionServiceProvider;

class Standard extends Application {

	/**
	 * @var array
	 */
	protected $ignorableInConsoleList = [
		IgnitionServiceProvider::class,
	];

	/**
	 * Register all of the configured providers.
	 *
	 * @return void
	 */
	public final function registerConfiguredProviders() {
		$providers = Collection::make($this->config['app.providers'])->filter(function ($class){
			return !app()->runningInConsole() || !property_exists($class, 'ignorableInConsole') || !$class::$ignorableInConsole;
		})->partition(function ($provider) {
			return Str::startsWith($provider, 'Illuminate\\');
		});

		$providers->splice(1, 0, [
			array_filter($this->make(PackageManifest::class)->providers(), function(string $class){
					return !app()->runningInConsole() ||  !in_array($class, $this->ignorableInConsoleList);
				})
		]);

		(new ProviderRepository($this, new Filesystem, $this->getCachedServicesPath()))
			->load($providers->collapse()->toArray());
	}

}
