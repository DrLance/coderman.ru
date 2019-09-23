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

	  $pages = 2;

	  for ($i = 1; $i <= $pages; $i++) {
		  $chromeVer = mt_rand(50, 75);

		  $context = stream_context_create(
			  array(
				  'http' => array(
					  'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/' . $chromeVer . '.0.2661.102 Safari/537.36',
				  ),
			  ));

		  $prefix = 'https://www.upwork.com';
		  $link   = $prefix . '/search/jobs/?page=' . $i;

		  $html = file_get_contents($link, false, $context);

		  $crawler  = new Crawler($html);
		  $projects = $crawler->filter('div.js-search-results')->children();

		  foreach ($projects as $item) {
			  $domItem = new Crawler($item);
			  $title   = $domItem->filter('a.job-title-link');
			  if ( ! $title->count()) {
				  continue;
			  }

			  $title       = $title->text();
			  $url         = $prefix . $domItem->filter('a.job-title-link')->attr('href');
			  $description = $domItem->filter('div.description span.js-description-text')->text();

			  $parsedData = ParsedData::whereUrl($url)->get();

			  if ( ! $parsedData->count()) {
				  $nparsedData = new ParsedData();

				  $nparsedData->title             = html_entity_decode($title);
				  $nparsedData->url               = $url;
				  $nparsedData->description       = $description;
				  $nparsedData->date_published_at = Carbon::now();
				  $nparsedData->category_name     = 'No category';
				  $nparsedData->type_id           = $this->type;
				  $nparsedData->save();
			  }

		  }
	  }
  }
}
