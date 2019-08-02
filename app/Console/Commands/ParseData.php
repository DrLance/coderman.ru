<?php

namespace App\Console\Commands;

use App\Http\Controllers\Parser\FlController;
use App\Http\Controllers\Parser\FreelanceHuntController;
use App\Http\Controllers\Parser\FreelanceRuController;
use App\Http\Controllers\Parser\FreelansimController;
use App\Http\Controllers\Parser\GuruController;
use App\Http\Controllers\Parser\WeblancerController;
use Illuminate\Console\Command;

class ParseData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:data';

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
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $freelanceHunt = new FreelanceHuntController();
        $weblancer = new WeblancerController();
        $fl = new FlController();
        $freelanceRu = new FreelanceRuController();
        $freelansim = new FreelansimController();
        $guru = new GuruController();
        $freelanceHunt->fillData();
        $weblancer->fillData();
        $fl->fillData();
        $freelanceRu->fillData();
        $freelansim->fillData();
        $guru->fillData();

        return true;
    }
}
