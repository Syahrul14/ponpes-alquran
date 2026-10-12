<?php

namespace App\Providers;

use App\Models\Administrator\Page_Banner\PageBannerModel;
use Illuminate\Support\Facades\View;
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
        View::composer('website.*', function ($view) {
            $pageBanner = PageBannerModel::first();
            $view->with('globalPageBanner', $pageBanner);
        });
    }
}
