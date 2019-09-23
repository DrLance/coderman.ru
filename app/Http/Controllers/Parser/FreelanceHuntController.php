<?php


namespace App\Http\Controllers\Parser;


use App\Http\Controllers\Controller;
use App\Models\ParsedData;
use App\Notifications\NewParsedItem;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Symfony\Component\DomCrawler\Crawler;

class FreelanceHuntController extends Controller {

  use Notifiable;

  private $type = 1;

  public function fillData() : void {

	  $pages = 3;

	  for ($i = 1; $i <= $pages; $i++) {

		  $link = 'https://freelancehunt.ru/projects?page=' . $i;
		  $html = file_get_contents($link);

		  $crawler = new Crawler(null, $link);
		  $crawler->addHtmlContent($html, 'UTF-8');

		  $table = $crawler->filter('table > tbody')->children();

		  foreach ($table as $item) {
			  $datePublished = $item->getAttribute('data-published');

			  $titleUrl = new Crawler($item);

			  $aTitle = $titleUrl->filter('a');

			  $title = $aTitle->text();

			  $url = $aTitle->attr('href');

			  $description = $aTitle->attr('title');

			  $categoryName = $titleUrl
				  ->filter('div > small')
				  ->getNode(0) ? $titleUrl->filter('div > small')->text() : '';

			  $parsedData = ParsedData::whereUrl($url)->get();

			  if ( ! $parsedData->count()) {
				  $nparsedData = new ParsedData();

				  $nparsedData->title             = $title;
				  $nparsedData->url               = $url;
				  $nparsedData->description       = $description;
				  $nparsedData->date_published_at = Carbon::createFromTimestamp($datePublished);
				  $nparsedData->category_name     = $categoryName;
				  $nparsedData->type_id           = $this->type;
				  $nparsedData->save();
			  }

		  }
	  }
  }

}
