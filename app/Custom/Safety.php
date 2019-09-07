<?php
namespace App\Custom;

use \Illuminate\Support\Facades\DB;
use \Throwable;

class Safety {

	/**
	 * @param callable $Handler
	 * @throws Throwable
	 */
	public final static function run(callable $Handler): void {
		DB::beginTransaction();

		try {
			call_user_func($Handler);

			Db::commit();
		} catch (Throwable $Exception) {
			Db::rollBack();

			throw $Exception;
		}
	}
}
