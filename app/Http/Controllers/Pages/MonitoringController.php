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
		$parsedData = ParsedData::orderBy('created_at', 'DESC')->limit(50)->get();

		return response()->json($parsedData);
	}

}
