<?php

namespace App\Providers;

use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;
use App\Http\viewComposers\HeaderComposer;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer(
        [
            'components.navbar_component',
            'components.aside_component',
            'components.footer_component',
            '*'
        ], HeaderComposer::class);


        Carbon::setUTF8(true);
        Carbon::setLocale(config('fr'));
        setlocale(LC_TIME, config('fr'));
        // setlocale(LC_TIME, config('app.locale'));
        // \Carbon\Carbon::setLocale('fr');
        Paginator::useBootstrap();
    }
}
