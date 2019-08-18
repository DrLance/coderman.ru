<?php


namespace App\Http\Controllers\Parser;


use App\Http\Controllers\Controller;
use App\Models\ParsedData;
use Carbon\Carbon;
use Symfony\Component\DomCrawler\Crawler;

class GuruController extends Controller {

	private $type = 6;

  public function fillData() : void {
    $link = 'https://www.guru.com';
    $html = file_get_contents($link .'/d/jobs/');

    $crawler = new Crawler(null, $link);
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

	    if($parsedData->count() === 10000) {
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
