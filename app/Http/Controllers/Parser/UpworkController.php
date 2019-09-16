<?php


namespace App\Http\Controllers\Parser;


use App\Http\Controllers\Controller;
use App\Models\ParsedData;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class UpworkController extends Controller {

	private $type = 7;

  public function fillData() : void {

	  $prefix = 'https://www.upwork.com';
	  $link = $prefix. '/search/jobs/';

	  $client = new Client([
		  'allow_redirects' => true,
		  'decode_content' => true
	  ]);
	  $res = $client->request('GET', $link, [
		  'headers' => [
		  	'user-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.75 Safari/537.36',
			  'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3'
		  ]
	  ]);

	  dd($res);

    $crawler = new Crawler($html);
    $projects =$crawler->filter('div.js-search-results')->children();

    foreach ($projects as $item) {
      $domItem = new Crawler($item);

      $title = $domItem->filter('a.job-title-link')->text();
      $url = $prefix.$domItem->filter('a.job-title-link')->attr('href');
      $description = $domItem->filter('div.description span')->text();

      dump($title);

	    $parsedData = ParsedData::whereUrl($url)->get();

	    if(!$parsedData->count()) {
		    $nparsedData = new ParsedData();

		    $nparsedData->title = $title;
		    $nparsedData->url = $url;
		    $nparsedData->description = $description;
		    $nparsedData->date_published_at = Carbon::now();
		    $nparsedData->category_name = 'Без категории';
		    $nparsedData->type_id = $this->type;
		    $nparsedData->save();
	    }

    }
  }

}
