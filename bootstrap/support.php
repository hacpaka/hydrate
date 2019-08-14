<?php

if (!function_exists('unit_path')) {

	/**
	 * Get the path to the units folder of the install.
	 *
	 * @param string $path
	 * @return string
	 */
	function unit_path($path = '') {
		return app()->unitPath($path);
	}
}
