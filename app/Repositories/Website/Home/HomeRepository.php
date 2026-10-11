<?php

namespace App\Repositories\Website\Home;

use App\Models\Administrator\Home\HomeBannerModel;
use App\Models\Administrator\Home\HomeProfileModel;
use App\Models\Administrator\Home\HomeAlumniModel;

class HomeRepository
{

    public function getHomeContent()
    {
        return [
            'home_banner' => $this->cmsHomeBanner(),
            'home_profile' => $this->cmsHomeProfile(),
            'home_alumni' => $this->cmsHomeAlumni(),
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

    public function cmsHomeAlumni()
    {
        return HomeAlumniModel::latest()->get();
    }
}