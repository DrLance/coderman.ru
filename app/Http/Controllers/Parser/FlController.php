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
	  $prefix = 'https://www.fl.ru';
	  $link = $prefix. '/projects/?kind=5';

	  $client = new Client();
	  $res = $client->request('GET', $link, [
	  	'headers' => ['User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36']
	  ]);

	  $html = $res->getBody()->getContents();

    $crawler = new Crawler($html);
    $projects =$crawler->filter('h2.b-post__title');

    foreach ($projects as $item) {
      $domItem = new Crawler($item);

      $title = $domItem->filter('a')->text();
      $url = $prefix.$domItem->filter('a')->attr('href');

	    $clientDesc = new Client();

	    $htmlTask = $clientDesc->request('GET', $url, [
		    'headers' => ['User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36']
	    ]);

	    $crawlerTask = new Crawler($htmlTask->getBody()->getContents());

	    $parsedData = ParsedData::whereUrl($url)->get();

	    if(!$parsedData->count()) {
		    $nparsedData = new ParsedData();

		    $nparsedData->title = $title;
		    $nparsedData->url = $url;
		    $nparsedData->description = $crawlerTask->filter('div.b-layout__txt.b-layout__txt_padbot_20')->text();
		    $nparsedData->date_published_at = Carbon::now();
		    $nparsedData->category_name = 'Без категории';
		    $nparsedData->type_id = $this->type;
		    $nparsedData->save();
	    }

    }
  }

}
