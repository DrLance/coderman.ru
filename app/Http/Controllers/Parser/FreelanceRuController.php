<?php


namespace App\Http\Controllers\Parser;


use App\Http\Controllers\Controller;
use App\Models\ParsedData;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class FreelanceRuController extends Controller {

	private $type = 4;

  public function fillData() : void {
	  $prefix = 'https://freelance.ru';
	  $link = $prefix. '/vacancy/';

	  $client = new Client();
	  $res = $client->request('GET', $link, [
	  	'headers' => ['User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36']
	  ]);

	  $html = $res->getBody()->getContents();

    $crawler = new Crawler($html);
    $projects =$crawler->filter('div.projects')->children();

    foreach ($projects as $item) {
      $domItem = new Crawler($item);
      $title = utf8_decode($domItem->filter('a')->text());
	    $title = mb_convert_encoding($title, 'UTF-8','cp-1251');
      $description = utf8_decode($domItem->filter('a.descr span')->last()->text());
	    $description = mb_convert_encoding($description, 'UTF-8','cp-1251');

      $url = $prefix.$domItem->filter('a')->attr('href');

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
