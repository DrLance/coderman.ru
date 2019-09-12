<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Backpack\PageManager\app\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller {

	public function index(Request $request) {

		$types = Type::all();

		return view('welcome', ['types' => $types]);
	}

	public function about(Request $request) {
		$page = Page::findBySlug('about');

		if ( ! $page) {
			abort(404);
		}

		return view('pages.about_us', ['page' => $page->withFakes()]);
	}

	public function test(Request $request) {

		/*		$fl = new FreelansimController();


				$fl->fillData();*/

		$statData = DB::table('parsed_data')
		              ->join('types', 'parsed_data.type_id', '=', 'types.id')
		              ->select(DB::raw('count(*) as types_count, types.name as type_name'))
		              ->groupBy('types.id')
		              ->get();

		dump($statData);

	}

}
