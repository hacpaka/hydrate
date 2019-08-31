<?php

/**
 * The unit root folder.
 *
 * @package Laravel MPS
 * @author Kassius Kress <hacpaka@eggbe.com>
 */
define('UNIT_PATH', dirname(__DIR__));

/*
|--------------------------------------------------------------------------
| Points to the standard Laravel loader
|--------------------------------------------------------------------------
|
| The primary principle of Laravel MPD build - it has to work as close
| to the original Laravel as it's possible.
|
*/

include UNIT_PATH . '/../../index.php';
