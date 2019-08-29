<?php
namespace App\Exceptions;

use \Illuminate\Http\Request;
use \Illuminate\Http\Response;

use \Exception;

class Handler
	extends \Illuminate\Foundation\Exceptions\Handler {

	/**
	 * A list of the inputs that are never flashed for validation exceptions.
	 *
	 * @var array
	 */
	protected $dontFlash = [
		'password',
		'password_confirmation',
	];

	/**
	 * Report or log an exception.
	 *
	 * @param Exception $Exception
	 * @return void
	 * @throws Exception
	 */
	public function report(Exception $Exception) {
		parent::report($Exception);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param Request $request
	 * @param Exception $exception
	 * @return Response
	 * @throws Exception
	 */
	public function render($request, Exception $exception) {
		return parent::render($request, $exception);
	}
}
