<?php


namespace App\Http\Controllers\Pages;
use App\Models\ParsedData;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MonitoringController extends Controller {

	public function index() {
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
			}

		}


		return response()->json($parsedData->orderBy('created_at', 'DESC')->limit(43)->get());
	}

}
