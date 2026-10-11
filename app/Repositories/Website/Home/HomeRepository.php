<?php

namespace App\Repositories\Website\Home;

use App\Models\Administrator\Home\HomeBannerModel;

class HomeRepository
{

    public function getHomeContent()
    {
        return [
            'home_banner' => $this->cmsHomeBanner()
        ];
    }

    public function cmsHomeBanner()
    {
        return HomeBannerModel::firstOrNew();
    }
}