<?php


namespace App\Http\Controllers\Pages;

use App\Models\ParsedData;
use App\Http\Controllers\Controller;
use Backpack\PageManager\app\Models\Page;
use Illuminate\Http\Request;

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

        $parsedData = ParsedData::query()->with('type');
        $limit      = 50;

        $filter = $request->input('filter');

        if (isset($filter['show'])) {
            $limit = $filter['show'];
        }

        if ($filter) {

            if(isset($filter['keywords'])) {

                foreach ($filter['keywords'] as $keyword) {
                    $parsedData->orWhere('title', 'like', '%' . $keyword . '%');
                    $parsedData->orWhere('description', 'like', '%' . $keyword . '%');
                }
            }


            if (isset($filter['selectedType']) && $filter['selectedType'] != 0) {
                $parsedData->whereTypeId($filter['selectedType']);

                /*				$parsedData->with(['type' => function ($query) use($filter) {
                          $query->where('id', '=', $filter['selectedType']);

                        }]);*/
            }
        }

        $results = $parsedData
          ->orderBy('created_at', 'DESC')
          ->orderBy('id', 'DESC')
          ->limit($limit)
          ->get();

        return response()->json($results);
    }

}
