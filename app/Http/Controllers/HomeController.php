<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;

class HomeController extends Controller
{
    public function index() {

      $link = 'https://freelancehunt.ru/projects';
      $html = file_get_contents($link);

      $crawler = new Crawler(null, $link);
      $crawler->addHtmlContent($html,'UTF-8');

      $table =$crawler->filter('table > tbody')->children();

      foreach ($table as $item) {
        $titleUrl = new Crawler($item);
        $title = $titleUrl->filter('a')->text();
        $url = $titleUrl->filter('a')->attr('href');
        $description = $titleUrl->filter('a')->attr('data-original-title');

        dump($title,$url,$description);

      }

      return view('welcome');
    }
}
