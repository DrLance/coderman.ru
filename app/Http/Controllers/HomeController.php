<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Parser\FreelansimController;
use App\Http\Controllers\Parser\GuruController;
use App\Models\Type;
use Backpack\PageManager\app\Models\Page;
use Illuminate\Http\Request;

class HomeController extends Controller {

	public function index(Request $request) {

		$types = Type::all();

		return view('welcome',  ['types' => $types]);
	}

	public function about(Request $request) {
		$page = Page::findBySlug('about');

		if(!$page) abort(404);

		return view('pages.about_us',['page' => $page->withFakes()]);
	}

	public function test(Request $request) {

		$fl = new FreelansimController();


		$fl->fillData();
	}

}
