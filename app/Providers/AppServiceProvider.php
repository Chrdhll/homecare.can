<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Filament\Facades\Filament;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\URL;

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
        Schema::defaultStringLength(191);


        Filament::registerRenderHook(
            'panels::styles.after',
            fn () => new HtmlString('<link rel="stylesheet" href="' . asset('css/admin-zoom-fix.css') . '">'),
        );


        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

    }
}
