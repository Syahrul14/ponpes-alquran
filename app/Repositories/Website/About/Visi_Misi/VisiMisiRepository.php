<?php

namespace App\Repositories\Website\About\Visi_Misi;

use App\Models\Administrator\About\Visi_Misi\VisiModel;
use App\Models\Administrator\About\Visi_Misi\MisiModel;

class VisiMisiRepository
{
    public function getVisiMisiContent()
    {
        return [
            'visi' => $this->cmsVisi(),
            'misi' => $this->cmsMisi(),
        ];
    }

    public function cmsVisi()
    {
        return VisiModel::firstOrNew();
    }

    public function cmsMisi()
    {
        return MisiModel::firstOrNew();
    }
}

