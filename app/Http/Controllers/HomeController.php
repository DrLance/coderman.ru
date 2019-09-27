<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Pages\StatController;
use App\Http\Controllers\Parser\PchelController;
use App\Http\Controllers\Parser\UpworkController;
use App\Models\Type;
use Backpack\PageManager\app\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App;

class HomeController extends Controller {

	public $data;

	public function index(Request $request) {

		$types = Type::all();

		$this->data['types'] = $types;

		$page = Page::findBySlug('home');

		if($page) {
			$this->data['page'] = $page->withFakes();
		}

		return view('welcome', $this->data);
	}

	public function about(Request $request) {
		$page = Page::findBySlug('about');

		if ( ! $page) {
			abort(404);
		}

		return view('pages.about_us', ['page' => $page->withFakes()]);
	}

	public function lang($locale)
	{
		App::setLocale($locale);
		session()->put('locale', $locale);
		return redirect()->back();
	}


	public function test(Request $request) {

				$fl = new UpworkController();
				$fl->fillData();

	}

}
