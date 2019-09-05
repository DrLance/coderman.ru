<?php


namespace App\Http\Controllers\Parser;


use App\Http\Controllers\Controller;
use App\Models\ParsedData;
use Carbon\Carbon;
use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Client;

class GuruController extends Controller {

	private $type = 6;

  public function fillData() : void {
    $link = 'http://www.guru.com';
    $prefix = '/d/jobs/';

	  $client = new Client(['verify' => false]);
	  $res = $client->request('GET', $link . $prefix, [
		  'headers' => ['User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36']
	  ]);

	  $html = $res->getBody()->getContents();

    $crawler = new Crawler(null, $link.$prefix);
    $crawler->addHtmlContent($html);

    $table =$crawler->filter('ul#serviceList')->children();

    foreach ($table as $item) {
      $domElement = new Crawler($item);
      $linkTask  = $domElement->filter('a');
      $title = $linkTask->text();
      $url = $link . $linkTask->attr('href');
      $description = $domElement->filter('p.jobRecord__desc')->text();

      $category = $domElement->filter('a.skillsList__skill');

      if($category->count() > 0) {
      	$category = $category->first()->text();
      } else {
      	$category = 'Без категории';
      }

	    $parsedData = ParsedData::whereUrl($url)->get();

	    if(!$parsedData->count()) {
		    $nparsedData = new ParsedData();

		    $nparsedData->title = $title;
		    $nparsedData->url = $url;
		    $nparsedData->description = $description;
		    $nparsedData->date_published_at = Carbon::now();
		    $nparsedData->category_name = $category;
		    $nparsedData->type_id = $this->type;
		    $nparsedData->save();
	    }
    }
  }

}
