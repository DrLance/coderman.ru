<?php


namespace App\Http\Controllers\Pages;

use App\Models\ParsedData;
use App\Http\Controllers\Controller;
use Backpack\PageManager\app\Models\Page;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatController extends Controller {

	public $data;

	public function index() {

		$page = Page::findBySlug('stat');

		$this->data['page'] = $page->withFakes();

		return view('pages.stat',$this->data);
	}

	public function getStats(Request $request) {
		$statData = [];

		$filter = $request->input('filter');

		if ($filter) {
			$dateStart = new Carbon($filter['dateStart']);
			$dateEnd   = new Carbon($filter['dateEnd']);

			if ($filter['dateStart'] && $filter['dateEnd']) {

				$t1 = $dateStart->format('Y-m-d');
				$t2 = $dateEnd->format('Y-m-d');

				$statData = DB::table('parsed_data')
				              ->whereBetween("parsed_data.created_at", [$t1, $t2])
				              ->join('types', 'parsed_data.type_id', '=', 'types.id')
				              ->select(DB::raw('count(*) as uv, types.name as name'))
				              ->groupBy('types.name')
				              ->orderBy('uv', 'DESC')
				              ->get();
			}

		} else {
			$now = Carbon::now();
			$t1  = $now;
			$t2  = $now->subMonth();

			$statData = DB::table('parsed_data')
			              ->whereBetween("parsed_data.created_at", [$t1, $t2])
			              ->join('types', 'parsed_data.type_id', '=', 'types.id')
			              ->select(DB::raw('count(*) as uv, types.name as name'))
			              ->groupBy('types.name')
			              ->orderBy('uv', 'DESC')
			              ->get();
		}


		return response()->json($statData);
	}

	public function getDayStats(Request $request) {
		$statData = [];

		$t1 = Carbon::now()->startOfDay();
		$t2 = Carbon::now()->endOfDay();

		$statData = DB::table('parsed_data')
		              ->whereBetween("parsed_data.created_at", [$t1, $t2])
		              ->join('types', 'parsed_data.type_id', '=', 'types.id')
		              ->select(DB::raw('count(*) as project_count, types.name as name, types.img_url'))
		              ->groupBy('types.name', 'types.img_url')
		              ->orderBy('project_count', 'DESC')
		              ->get();


		return response()->json($statData);
	}

}
