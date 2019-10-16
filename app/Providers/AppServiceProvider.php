<?php

namespace App\Providers;

use App\Models\ParsedData;
use App\Observers\ParsedDataObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ParsedData::observe(ParsedDataObserver::class);
        Paginator::defaultView('components.paginate');
        Schema::defaultStringLength(191);
    }
}
