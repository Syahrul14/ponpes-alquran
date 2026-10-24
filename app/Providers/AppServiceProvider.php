<?php

namespace App\Providers;

use App\Models\Administrator\Page_Banner\PageBannerModel;
use App\Models\Administrator\Setting\FooterSettingModel;
use App\Models\Administrator\Setting\FooterSocialMediaModel;
use App\Models\Administrator\Contact\ContactInfoModel;
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
            $footerSetting = FooterSettingModel::first();
            $socialMedia = FooterSocialMediaModel::where('is_active', true)->orderBy('order', 'asc')->orderBy('id', 'asc')->get();
            $contactInfo = ContactInfoModel::first();

            $view->with([
                'globalPageBanner' => $pageBanner,
                'globalFooter' => $footerSetting,
                'globalSocialMedia' => $socialMedia,
                'globalContact' => $contactInfo,
            ]);
        });
    }
}
