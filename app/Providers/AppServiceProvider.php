<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
    view()->share('trainTypes', [
        'Nozomi' => 'Nozomi',
        'Hikari' => 'Hikari',
        'Kodama' => 'Kodama',
        'Mizuho' => 'Mizuho',
        'Sakura' => 'Sakura'
    ]);
    }
}
