<?php
namespace App\Console\Commands;

use \Illuminate\Console\Command;

class UnitsList extends Command {

	/**
	 * The name and signature of the console command.
	 * @var string
	 */
	protected $signature = 'units:list';

	/**
	 * The console command description.
	 * @var string
	 */
	protected $description = 'Displays the list of units.';

	/**
	 * Execute the console command.
	 * @return mixed
	 */
	public function handle() {
		try {
			$count = 0;

			foreach (array_filter(scandir(base_path('units')), function (string $value){
				return !preg_match('/^\.+/', $value); }) as $localUnitFolder){
					$this->comment($localUnitFolder);

				$count++;
			}

			$this->info("\nTotal: " . $count);
		}catch (\Exception $Exception){
			$this->error($Exception->getMessage());
		}
	}
}
