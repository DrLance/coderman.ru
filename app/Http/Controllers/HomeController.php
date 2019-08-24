<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Parser\FreelansimController;
use App\Http\Controllers\Parser\GuruController;
use App\Models\ParsedData;
use App\Models\Type;
use Illuminate\Http\Request;

class HomeController extends Controller {
	public function index(Request $request) {

		$types = Type::all();

		return view('welcome',  ['types' => $types]);
	}

	public function test(Request $request) {

		$fl = new GuruController();


		$fl->fillData();
	}

}
