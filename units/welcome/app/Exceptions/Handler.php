<?php
namespace Units\Welcome\Exceptions;

use \Exception;

class Handler
	extends	\App\Exceptions\Handler {

	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
	];

}
