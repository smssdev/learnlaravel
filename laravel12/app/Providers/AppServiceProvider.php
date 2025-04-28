<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
            // to disable lazy loading

            // Model::preventLazyLoading(! app()->environment('production'));
        }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
