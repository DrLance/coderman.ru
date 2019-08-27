<?php


namespace App\Http\Controllers\Parser;


use App\Http\Controllers\Controller;
use App\Models\ParsedData;
use Carbon\Carbon;
use Symfony\Component\DomCrawler\Crawler;

class WeblancerController extends Controller {

	private $type = 2;

  public function fillData() : void {
    $link = 'https://www.weblancer.net/jobs/';
    $html = file_get_contents($link);

    $crawler = new Crawler(null, $link);
    $crawler->addHtmlContent($html, 'cp-1251');

    $table =$crawler->filter('div.page_content > div.cols_table')->children();

    foreach ($table as $item) {
      $titleUrl = new Crawler($item);

      $datePublished = $titleUrl->filter('span.time_ago')->attr('data-timestamp');



      $aTitle = $titleUrl->filter('h2.title');
      $title = $aTitle->text();
      $url = 'https://www.weblancer.net' . $aTitle->filter('h2.title > a')->attr('href');

      $description = $titleUrl->filter('p.text_field')->text();
      $categoryName = $titleUrl->filter('div.col-sm-8.text-muted.dot_divided > span > a')->text();

      $parsedData = ParsedData::whereUrl($url)->get();

      if(!$parsedData->count()) {
        $nparsedData = new ParsedData();

        $nparsedData->title = $title;
        $nparsedData->url = $url;
        $nparsedData->description = $description;
        $nparsedData->date_published_at = Carbon::createFromTimestamp($datePublished);
        $nparsedData->category_name = $categoryName;
        $nparsedData->type_id = $this->type;
        $nparsedData->save();
      }

    }
  }

}
