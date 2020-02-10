<?php

namespace App\Http\Controllers;

use Backpack\PageManager\app\Models\Page;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index($slug, $subs = null)
    {
        $page = Page::whereSlug($slug)->whereNotIn('type', ['articles', 'news'])->first();

        if($subs) {
            $page = Page::whereType($slug)->whereSlug($subs)->first();
        }

        if ( ! $page) {
            abort(404, 'Please go back to our <a href="' . url('') . '">homepage</a>.');
        }

        $this->data['title'] = $page->title;
        $this->data['page']  = $page->withFakes();

        return view('pages.' . $page->template, $this->data);
    }

}
