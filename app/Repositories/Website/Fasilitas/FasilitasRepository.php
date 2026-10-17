<?php

namespace App\Repositories\Website\Fasilitas;

use App\Models\Administrator\Facility\FasilitasCardModel;

class FasilitasRepository
{
    public function getFasilitasContent()
    {
        return [
            'fasilitas_cards' => $this->cmsFasilitasCards(),
        ];
    }

    public function cmsFasilitasCards()
    {
        return FasilitasCardModel::all();
    }
}

