<?php
namespace App\Custom;

use \Dotenv\Loader;
use \Dotenv\Exception\InvalidPathException;

use \PhpOption\Option;

class Merger extends Loader {

	/**
	 * Load the environment file from disk.
	 *
	 * @return array<string|null>
	 * @throws InvalidPathException|InvalidFileException
	 */
	public final function load() {
		return $this->loadDirect(
			self::findAndMerge($this->filePaths)
		);
	}

	/**
	 * Attempt to read the files in order.
	 *
	 * @param string[] $filePaths
	 *
	 * @return string
	 * @throws InvalidPathException
	 *
	 */
	private final static function findAndMerge(array $filePaths) {
		if ($filePaths === []) {
			throw new InvalidPathException('At least one environment file path must be provided.');
		}

		$strings = [];
		foreach ($filePaths as $filePath) {
			$lines = self::readFromFile($filePath);

			if ($lines->isDefined()) {
				array_push($strings, $lines->get());
			}
		}

		if (count($strings) < 1) {
			throw new InvalidPathException(
				sprintf('Unable to read any of the environment file(s) at [%s].', implode(', ', $filePaths))
			);
		}

		return implode("\n", $strings);
	}

	/**
	 * Read the given file.
	 * @param string $filePath
	 * @return \PhpOption\Option
	 */
	private static function readFromFile($filePath) {
		$content = @file_get_contents($filePath);

		return Option::fromValue($content, false);
	}
}
