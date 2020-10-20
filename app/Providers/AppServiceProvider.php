<?php

namespace App\Providers;

use Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Routing\UrlGenerator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if(in_array(Request::ip(), ['167.0.166.144'])) {
//        \Debugbar::enable();
        // Forcing the cache to be cleared2
        // Not recommended but if and only if required
//        \Artisan::call('cache:clear');
    }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {

            //$url->forceScheme('https');

    }
}
