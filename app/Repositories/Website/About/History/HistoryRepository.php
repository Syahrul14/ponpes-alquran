<?php

namespace App\Repositories\Website\About\History;

use App\Models\Administrator\About\History\HistoryBannerModel;
use App\Models\Administrator\About\History\HistoryProfileModel;

class HistoryRepository
{
    public function getHistoryContent()
    {
        return [
            'history_banner' => $this->cmsHistoryBanner(),
            'history_profile' => $this->cmsHistoryProfile(),
        ];
    }

    public function cmsHistoryBanner()
    {
        return HistoryBannerModel::firstOrNew();
    }

    public function cmsHistoryProfile()
    {
        return HistoryProfileModel::firstOrNew();
    }
}

