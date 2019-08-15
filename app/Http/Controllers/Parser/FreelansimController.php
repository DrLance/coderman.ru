<?php


namespace App\Http\Controllers\Parser;


use App\Http\Controllers\Controller;
use App\Models\ParsedData;
use Carbon\Carbon;
use Symfony\Component\DomCrawler\Crawler;

class FreelansimController extends Controller {

	private $type = 5;

  public function fillData() : void {
    $link = 'https://freelansim.ru';
    $postFix = '/tasks';
    $html = file_get_contents($link.$postFix);

    $crawler = new Crawler(null, $link);
    $crawler->addHtmlContent($html);

    $table =$crawler->filter('ul.content-list_tasks')->children();

    foreach ($table as $item) {
      $domElement = new Crawler($item);
      $linkTask  = $domElement->filter('a');
      $title = $linkTask->text();
      $url = $link . $linkTask->attr('href');

      $htmlTask = file_get_contents( $url);
	    $crawlerTask = new Crawler($htmlTask);

	    $parsedData = ParsedData::whereUrl($url)->get();

	    if(!$parsedData->count()) {
		    $nparsedData = new ParsedData();

		    $description = $crawlerTask->filter('div.task__description')->text();
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
