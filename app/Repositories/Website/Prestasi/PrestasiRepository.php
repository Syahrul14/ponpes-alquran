<?php

namespace App\Repositories\Website\Prestasi;

use App\Models\Administrator\Academic\Prestasi\PrestasiCardModel;

class PrestasiRepository
{
    public function getPrestasiContent()
    {
        return [
            'prestasi_cards' => $this->cmsPrestasiCards(),
        ];
    }

    public function cmsPrestasiCards()
    {
        return PrestasiCardModel::all();
    }
}

