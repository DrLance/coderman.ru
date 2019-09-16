<?php


namespace App\Http\Controllers\Parser;


use App\Http\Controllers\Controller;
use App\Models\ParsedData;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class PchelController extends Controller {

	private $type = 8;

  public function fillData() : void {

	  $prefix = 'https://pchel.net';
	  $link = $prefix. '/jobs/';

	  /*$client = new Client(['verify' => false]);
	  $res = $client->request('GET', $link, [
		  'referer' => true,
		  'headers' => [
			  'Accept-Encoding' => 'gzip, deflate, br',
		  ],
	  ]);
	  $html = $res->getBody()->getContents();*/

	  $html = file_get_contents($link);

    $crawler = new Crawler($html);
    $projects =$crawler->filter('div.project-blocks')->children();

    foreach ($projects as $item) {
      $domItem = new Crawler($item);

      $title = $domItem->filter('div.project-title a')->text();

      $url = $prefix.$domItem->filter('div.project-title a')->attr('href');

      $description = $domItem->filter('div.project-text p')->text();

	    $parsedData = ParsedData::whereUrl($url)->get();

	    if(!$parsedData->count()) {
		    $nparsedData = new ParsedData();

		    $nparsedData->title = $title;
		    $nparsedData->url = $url;
		    $nparsedData->description = $description ?? $title;
		    $nparsedData->date_published_at = Carbon::now();
		    $nparsedData->category_name = 'Без категории';
		    $nparsedData->type_id = $this->type;
		    $nparsedData->save();
	    }

    }
  }

}
