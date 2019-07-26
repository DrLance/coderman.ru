<?php


namespace App\Http\Controllers\Parser;


use App\Http\Controllers\Controller;
use App\Models\ParsedData;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class FlController extends Controller {

	private $type = 3;

  public function fillData() : void {
	  $context = stream_context_create(
		  array(
			  "http" => array(
			  	'method' => 'GET',
				  "header" => "User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36"
			  )
		  )
	  );

	  $client = new Client();
	  $res = $client->request('GET', 'https://www.fl.ru/projects/?kind=5', [
	  	'headers' => ['User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36']
	  ]);

	  $html = $res->getBody()->getContents();
	  $prefix = 'https://www.fl.ru';
	  $link = $prefix. '/projects/?kind=5';
    $crawler = new Crawler($html);
    $projects =$crawler->filter('h2.b-post__title');

    foreach ($projects as $item) {
      $domItem = new Crawler($item);

      $title = $domItem->filter('a')->text();
      $url = $prefix.$domItem->filter('a')->attr('href');

	    $parsedData = ParsedData::whereUrl($url)->get();

	    if(!$parsedData->count()) {
		    $nparsedData = new ParsedData();

		    $nparsedData->title = $title;
		    $nparsedData->url = $url;
		    $nparsedData->description = $title;
		    $nparsedData->date_published_at = Carbon::now();
		    $nparsedData->category_name = 'Без категории';
		    $nparsedData->type_id = $this->type;
		    $nparsedData->save();
	    }

    }
  }

}
