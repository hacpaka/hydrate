<?php
namespace App\Custom;

use \Illuminate\Support\Collection;
use \Illuminate\Support\Str;

use \Illuminate\Filesystem\Filesystem;
use \Illuminate\Foundation\Application;
use \Illuminate\Foundation\PackageManifest;
use \Illuminate\Foundation\ProviderRepository;

class Standard extends Application {

	/**
	 * Register all of the configured providers.
	 *
	 * @return void
	 */
	public function registerConfiguredProviders() {
		$providers = Collection::make($this->config['app.providers'])->filter(function ($class){
			return !property_exists($class, 'ignoreConsole') || !$class::$ignoreConsole;
		})->partition(function ($provider) {
			return Str::startsWith($provider, 'Illuminate\\');
		});

		$providers->splice(1, 0, [$this->make(PackageManifest::class)->providers()]);

		(new ProviderRepository($this, new Filesystem, $this->getCachedServicesPath()))
			->load($providers->collapse()->toArray());
	}

}
