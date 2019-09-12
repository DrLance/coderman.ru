<?php


namespace App\Http\Controllers\Pages;

use App\Models\ParsedData;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatController extends Controller {

	public function index() {
		return view('pages.stat');
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
				              ->groupBy('parsed_data.type_id')
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
			              ->groupBy('parsed_data.type_id')
			              ->get();
		}


		return response()->json($statData);
	}

}
