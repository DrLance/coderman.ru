<?php

namespace App\Providers;

use App\Models\ParsedData;
use App\Observers\ParsedDataObserver;
use Illuminate\Support\ServiceProvider;

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
    }
}
