<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Backpack\PageManager\app\Models\Page;

Route::get('/', 'HomeController@index')->name('home');
Route::get('/test','HomeController@test')->name('test');
Route::get('/monitoring', 'Pages\MonitoringController@index')->name('monitoring');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/stat', 'Pages\StatController@index')->name('stat');



Route::get('/sitemap', function() {

	// create new sitemap object
	$sitemap = App::make('sitemap');

	// add items to the sitemap (url, date, priority, freq)
	$pages = Page::all();

	foreach ($pages as $page) {
		$sitemap->add(route($page->slug), '2012-08-25T20:10:00+02:00', '1.0', 'daily');
	}



	// show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
	return $sitemap->render('xml');
});

/** CATCH-ALL ROUTE for Backpack/PageManager - needs to be at the end of your routes.php file  **/
Route::get('{page}/{subs?}', ['uses' => 'PageController@index'])
     ->where(['page' => '^(((?=(?!admin))(?=(?!\/)).))*$', 'subs' => '.*']);

