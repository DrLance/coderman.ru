<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Parser\FreelansimController;
use App\Http\Controllers\Parser\GuruController;
use App\Models\ParsedData;
use App\Models\Type;
use Illuminate\Http\Request;

class HomeController extends Controller {
	public function index(Request $request) {

		$parsedData = ParsedData::query();

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
		$parsedData->orderBy('date_published_at', 'DESC')->limit(50);

		return view('welcome',
			['parsedData' => $parsedData->get(), 'types' => $types, 'filter_type' => $filterType]);
	}

	public function test(Request $request) {

		$fl = new GuruController();

		$fl->fillData();
	}

}
