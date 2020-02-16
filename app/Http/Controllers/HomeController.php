<?php

namespace App\Http\Controllers;

use App\Models\ParsedData;
use App\Models\Type;
use Backpack\PageManager\app\Models\Page;
use Illuminate\Http\Request;
use App;

class HomeController extends Controller
{

    public $data;

    public function index()
    {

        $types = Type::all();

        $this->data['types'] = $types;

        $page = Page::findBySlug('home');

        if ($page) {
            $this->data['page'] = $page->withFakes();
        }

        $this->data['projects'] = ParsedData::with("type")->orderBy('created_at', 'DESC')
                                               ->orderBy('id', 'DESC')
                                               ->limit(15)
                                               ->get();

        $articles = Page::select(['slug', 'excerpt', 'title', 'type', 'created_at'])
                        ->whereType('articles')
                        ->orderBy('created_at', 'DESC')
                        ->limit(10)->get();

        $this->data['articles'] = $articles;

        return view('welcome', $this->data);
    }

    public function about(Request $request)
    {
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


    public function test(Request $request)
    {

    }

}
