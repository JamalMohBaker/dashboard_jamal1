<?php

namespace App\Providers;

use App\Models\News;
use App\Models\Tiles;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Paginator::useBootstrapFive();

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::share('lastnews', News::latest()->take(4)->get());
        View::share('tiles', Tiles::get());
    }
}
