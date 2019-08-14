<?php
namespace App\Custom;

use \Illuminate\Support\Collection;
use \Illuminate\Support\Str;

use \Illuminate\Filesystem\Filesystem;
use \Illuminate\Foundation\Application;
use \Illuminate\Foundation\PackageManifest;
use \Illuminate\Foundation\ProviderRepository;

class Unit extends Application {

	/**
	 * The custom unit path defined by the developer.
	 * @var string
	 */
	protected $unitPath = null;

	/**
	 * Get the units path.
	 *
	 * @param string $path
	 * @return string
	 */
	public function unitPath($path = ''): string {
		return $this->unitPath . ($path ? DIRECTORY_SEPARATOR . $path : $path);
	}

	/**
	 * Create a new unit instance.
	 * @param string $basePath
	 * @param string $unitPath
	 */
	public final function __construct(string $basePath = null, string $unitPath = null) {
		parent::__construct($basePath);

		$this->unitPath = $unitPath;
	}

	/**
	 * The custom unit environment path defined by the developer.
	 * @var string
	 */
	protected $unitEnvironmentPath = null;

	/**
	 * Get the path to the unit environment file directory.
	 * @return string
	 */
	public final function unitEnvironmentPath(): string {
		return $this->unitEnvironmentPath ?: $this->unitPath;
	}

	/**
	 * Set the directory for the unit environment file.
	 * @param string $path
	 * @return $this
	 */
	public function useUnitEnvironmentPath($path): string {
		$this->unitEnvironmentPath = $path;

		return $this;
	}

	/**
	 * Get the fully qualified path to the environment file.
	 * @return string
	 */
	public final function unitEnvironmentFilePath(): string {
		return $this->unitEnvironmentPath() . DIRECTORY_SEPARATOR . $this->environmentFile();
	}

	/**
	 * Get the path to the unit configuration files.
	 * @param string $path
	 * @return string
	 */
	public function unitConfigPath($path = '') {
		return $this->unitPath . DIRECTORY_SEPARATOR . 'config' . ($path ? DIRECTORY_SEPARATOR . $path : $path);
	}

	/**
	 * Bind all of the application paths in the container.
	 *
	 * @return void
	 */
	protected function bindPathsInContainer() {
		parent::bindPathsInContainer();

		$this->instance('path.unit', $this->unitPath());
	}
}
