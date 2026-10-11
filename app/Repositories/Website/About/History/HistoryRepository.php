<?php

namespace App\Repositories\Website\About\History;

use App\Models\Administrator\About\History\HistoryBannerModel;

class HistoryRepository
{
    public function getHistoryContent()
    {
        return [
            'history_banner' => $this->cmsHistoryBanner(),
        ];
    }

    public function cmsHistoryBanner()
    {
        return HistoryBannerModel::firstOrNew();
    }
}

