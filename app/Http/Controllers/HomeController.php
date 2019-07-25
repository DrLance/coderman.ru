<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Parser\FreelanceHuntController;
use App\Http\Controllers\Parser\WeblancerController;
use App\Models\ParsedData;
use App\Notifications\NewParsedItem;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Notification;

class HomeController extends Controller
{
    public function index() {

      $parsedData = ParsedData::query();
      $parsedData->orderBy('date_published_at','DESC');



      return view('welcome',['parsedData' => $parsedData->paginate(50)]);
    }

}
