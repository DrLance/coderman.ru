<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Parser\FreelanceHuntController;
use App\Models\ParsedData;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;

class HomeController extends Controller
{
    public function index() {

      $parsedData = ParsedData::query();
      $parsedData->orderBy('created_at','DESC');

      return view('welcome',['parsedData' => $parsedData->paginate(50)]);
    }
}
