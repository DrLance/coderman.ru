<?php

namespace App\Console\Commands;

use App\Http\Controllers\Parser\FlController;
use App\Http\Controllers\Parser\FreelanceHuntController;
use App\Http\Controllers\Parser\FreelanceRuController;
use App\Http\Controllers\Parser\FreelansimController;
use App\Http\Controllers\Parser\GuruController;
use App\Http\Controllers\Parser\PchelController;
use App\Http\Controllers\Parser\UpworkController;
use App\Http\Controllers\Parser\WeblancerController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ParseData extends Command {

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'parse:data {params}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		$params = $this->argument('params');

		try {
			if($params === '1') {
				$freelanceHunt = new FreelanceHuntController();
				$weblancer     = new WeblancerController();
				$fl            = new FlController();
				$freelanceRu   = new FreelanceRuController();
				$freelansim    = new FreelansimController();
				$pchel         = new PchelController();

				$freelanceHunt->fillData();
				$weblancer->fillData();
				$fl->fillData();
				$freelanceRu->fillData();
				$freelansim->fillData();
				$pchel->fillData();

				$guru = new GuruController();
				$guru->fillData();
			} elseif ($params === '5') {
				$upwork = new UpworkController();
				$upwork->fillData();
			}

		} catch (\Exception $e) {

			dump($e->getMessage());
			Log::debug($e->getMessage());

		}

		return true;
	}
}
