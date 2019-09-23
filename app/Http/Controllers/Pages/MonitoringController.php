<?php


namespace App\Http\Controllers\Pages;
use App\Models\ParsedData;
use App\Http\Controllers\Controller;
use Backpack\PageManager\app\Models\Page;
use Illuminate\Http\Request;

class MonitoringController extends Controller {

	public $data;

	public function index() {
		$page = Page::findBySlug('monitoring');

		if($page) {
			$this->data['page'] = $page->withFakes();

			return view('pages.monitoring', $this->data);
		}

		return view('pages.monitoring');
	}

	public function getData(Request $request) {

		$parsedData = ParsedData::query()->with('type');

		$filter = $request->input('filter');

		if ($filter) {

			if($filter['selectedType'] != 0) {
				$parsedData->whereTypeId($filter['selectedType']);

/*				$parsedData->with(['type' => function ($query) use($filter) {
					$query->where('id', '=', $filter['selectedType']);

				}]);*/
			}

			foreach ($filter['keywords']  as $keyword) {
				$parsedData->orWhere('title', 'like', '%' . $keyword . '%');
				$parsedData->orWhere('description', 'like', '%' . $keyword . '%');
			}

		}

		$results = $parsedData->orderBy('created_at', 'DESC')->limit(50)->get();

		return response()->json($results);
	}

}
