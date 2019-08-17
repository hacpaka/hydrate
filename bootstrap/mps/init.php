<?php
/*
| Validation of the unit root directory
|--------------------------------------------------------------------------
|
| The unit root directory has to be a subfolder
| of the application base directory.
|
*/

try {
	if (!defined('UNIT_PATH')) {
		throw new \Exception('Unit path is undefined!');
	}

	/**
	 * To guarantee the mps-feature properly work,
	 * the unit base directory has to be a subfolder
	 * of the application units folder.
	 */
	define('UNIT_NAME', call_user_func(function (){ if (!preg_match('/^' . preg_quote(__DIR__ . DIRECTORY_SEPARATOR . 'units'
		. DIRECTORY_SEPARATOR, '/') . '(.*)$/', rtrim(UNIT_PATH, DIRECTORY_SEPARATOR), $Matches)){
			throw new \Exception('Unit path is not a subfolder of the main directory!'); }

		/**
		 * Actually, the unit name it's the unit subfolder
		 * with some limitation: only Latin letters,
		 * underscore or dash characters.
		 */
		if (!preg_match('/^[A-Z0-9_-]/i', $Matches[1])){
			throw new \Exception(sprintf('Invalid unit name: %s!', $Matches[1]));
		}

		return $Matches[1];
	}));
}catch (\Throwable $Exception){
	trigger_error($Exception->getMessage(), E_USER_ERROR);
}
