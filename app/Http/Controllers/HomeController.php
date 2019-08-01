<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Parser\FreelansimController;
use App\Models\ParsedData;
use App\Models\Type;
use Illuminate\Http\Request;

class HomeController extends Controller {
	public function index(Request $request) {

		$parsedData = ParsedData::query();
		$parsedData->orderBy('date_published_at', 'DESC');
		$types = Type::all();

		$filterType = $request->input('filter_type', '0');
		$keywords   = $request->input('keywords');
		if ($filterType !== '0') {
			$parsedData->whereTypeId($filterType);
		}

		if ($keywords) {
			$parsedData->where('title', 'like', '%' . $keywords . '%')
			           ->orWhere('description', 'like', '%' . $keywords . '%');
		}

		return view('welcome',
			['parsedData' => $parsedData->paginate(50), 'types' => $types, 'filter_type' => $filterType]);
	}

	public function test(Request $request) {
		$fl = new FreelansimController();

		$fl->fillData();
	}

}
