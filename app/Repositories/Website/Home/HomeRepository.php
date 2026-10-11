<?php

namespace App\Repositories\Website\Home;

use App\Models\Administrator\Home\HomeBannerModel;
use App\Models\Administrator\Home\HomeProfileModel;

class HomeRepository
{

    public function getHomeContent()
    {
        return [
            'home_banner' => $this->cmsHomeBanner(),
            'home_profile' => $this->cmsHomeProfile(),
        ];
    }

    public function cmsHomeBanner()
    {
        return HomeBannerModel::firstOrNew();
    }

    public function cmsHomeProfile()
    {
        return HomeProfileModel::firstOrNew();
    }
}