<?php
namespace App\Custom;

use \Dotenv\Dotenv;
use \App\Custom\Merger;

use \Dotenv\Environment\DotenvFactory;
use \Dotenv\Environment\FactoryInterface;

class HierarchicalDotenv extends Dotenv {

	/**
	 * Create a new dotenv instance.
	 *
	 * @param string|string[] $paths
	 * @param null $file
	 * @param FactoryInterface|null $envFactory
	 * @return HierarchicalDotenv
	 */
	public static final function create($paths, $file = null, FactoryInterface $envFactory = null) {
		$Loader = new Merger(
			self::getFilePaths((array)$paths, $file ?: '.env'),
			$envFactory ?: new DotenvFactory(),
			true
		);

		return new self($Loader);
	}

	/**
	 * Returns the full paths to the files.
	 *
	 * @param string[] $paths
	 * @param string $file
	 *
	 * @return string[]
	 */
	private static function getFilePaths(array $paths, $file) {
		return array_map(function ($path) use ($file) {
			return rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $file;
		}, $paths);
	}
}
