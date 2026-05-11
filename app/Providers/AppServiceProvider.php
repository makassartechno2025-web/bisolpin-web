<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }

        try {
            // Only try to share settings if DB is available
            if (\Illuminate\Support\Facades\Schema::hasTable('site_settings')) {
                $globalSettings = \App\Models\SiteSetting::pluck('value', 'key')->toArray();
                \Illuminate\Support\Facades\View::share('globalSettings', $globalSettings);
            }
        } catch (\Exception $e) {
            // Ignore DB errors during deployment/migrations
        }
    }
}
