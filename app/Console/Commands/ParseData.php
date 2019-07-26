<?php

namespace App\Console\Commands;

use App\Http\Controllers\Parser\FlController;
use App\Http\Controllers\Parser\FreelanceHuntController;
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
        $freelanceHunt->fillData();
        $weblancer->fillData();
        $fl->fillData();
    }
}
