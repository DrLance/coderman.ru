<?php


namespace App\Http\Controllers\Pages;

use App\Models\ParsedData;
use App\Http\Controllers\Controller;
use Backpack\PageManager\app\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MonitoringController extends Controller
{

    public $data;

    public function index()
    {
        $page = Page::findBySlug('monitoring');

        if ($page) {
            $this->data['page'] = $page->withFakes();

            return view('pages.monitoring', $this->data);
        }

        return view('pages.monitoring');
    }

    public function getData(Request $request)
    {
        $t1 = microtime(true);

        $locale = 'ru';

        $parsedData = ParsedData::query()->with("type");
        $limit      = 25;

        $filter = $request->input('filter');

        if (isset($filter['show'])) {
            $limit = $filter['show'];
        }

        if ($filter) {
            if(isset($filter['keywords'])) {
                foreach ($filter['keywords'] as $keyword) {
                    $parsedData->orWhere('title', '~',  $keyword );
                    $parsedData->orWhere('description', '~',  $keyword);
                }
            }

            if (isset($filter['selectedType']) && $filter['selectedType'] != 0) {
                $parsedData->where('type_id',$filter['selectedType']);
            }

            if (isset($filter['selectedRegion'])) {
                $locale = $filter['selectedRegion'];
            }
        }

        $parsedData->whereHas('type',function ($q) use($locale) {
            $q->where('lang',$locale);
        });

        $results = $parsedData
          ->orderBy('created_at', 'DESC')
          ->orderBy('id', 'DESC')
          ->limit($limit)
          ->get();

        $t2 = microtime(true);

        Log::debug('end ' . ($t2 - $t1));

        return response()->json($results);
    }

}
