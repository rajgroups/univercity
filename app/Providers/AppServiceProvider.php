<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use App\Helpers\GcsAdapterFactory;
use App\Models\HomeSetting;
use App\Models\Settings;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

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
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);
        // Load the first HomeSetting record
        $settings = HomeSetting::first();
        $defaultSettings = Settings::first();
        // Share it with all views
        View::share(['settings' => $settings,'defaultSettings'=>$defaultSettings]);
    }
}
