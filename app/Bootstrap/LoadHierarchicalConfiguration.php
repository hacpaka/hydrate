<?php
namespace App\Bootstrap;

use \Illuminate\Contracts\Config\Repository;
use \Illuminate\Contracts\Foundation\Application;
use \Illuminate\Foundation\Bootstrap\LoadConfiguration;

use \Symfony\Component\Finder\Finder;

class LoadHierarchicalConfiguration extends LoadConfiguration {

	/**
	 * Load the configuration items from all of the files.
	 *
	 * @param Application $app
	 * @return array
	 *
	 * @throws \Exception
	 */
	protected final function getConfigurationFiles(Application $app) {
		$files = [];

		foreach (array_filter([realpath($app->configPath()), realpath($app->unitConfigPath())]) as $configPath) {
			foreach (Finder::create()->files()->name('*.php')->in($configPath) as $file) {
				array_push($files, [
					'path' => $file->getRealPath(),
					'prefix' => $this->getNestedDirectory($file, $configPath) . basename($file->getRealPath(), '.php')
				]);
			}
		}

		ksort($files, SORT_NATURAL);

		return $files;
	}

	/**
	 * Load the configuration items from all of the files.
	 *
	 * @param Application $App
	 * @param Repository $Repository
	 *
	 * @throws \Exception
	 */
	protected final function loadConfigurationFiles(Application $App, Repository $Repository) {
		$files = $this->getConfigurationFiles($App);

		foreach ($files as $info) {
			$Repository->set($info['prefix'],
				$this->mergeConfigurations($Repository->get($info['prefix'], []), require $info['path']));
		}

		if (!$Repository->has('app')){
			throw new \Exception('Unable to load the "app" configuration file.');
		}
	}

	/**
	 * Merges configurations.
	 *
	 * @param array $original
	 * @param array $replacement
	 * @return array
	 */
	private final function mergeConfigurations(array $original, array $replacement): array {
		return array_merge_recursive_distinct($original, $replacement);
	}
}
