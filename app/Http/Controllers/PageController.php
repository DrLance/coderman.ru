<?php

namespace App\Http\Controllers;

use Backpack\PageManager\app\Models\Page;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index($slug, $subs = null)
    {
        $page = Page::where('slug', $slug)->where('type', null)->first();

        $lastArticles = [];

        var_dump($subs);

        if ($subs) {
            $pageType = Page::where('type', $slug)->where('slug', $subs)->first();

            if ($pageType) {

                $lastArticles = Page::select(['slug', 'excerpt', 'title', 'type', 'created_at'])
                                    ->whereType('articles')
                                    ->where('id', '!=', $pageType->id)
                                    ->orderBy('created_at', 'DESC')
                                    ->limit(10)->get();
            }
        }

        if ( ! $page) {
            abort(404, 'Please go back to our <a href="' . url('') . '">homepage</a>.');
        }

        $this->data['title']         = $page->title;
        $this->data['page']          = $page->withFakes();
        $this->data['last_articles'] = $lastArticles;

        return view('pages.' . $page->template, $this->data);
    }

}
