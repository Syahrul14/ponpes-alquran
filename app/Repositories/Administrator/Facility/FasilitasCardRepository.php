<?php

namespace App\Repositories\Administrator\Facility;

use App\Models\Administrator\Facility\FasilitasCardModel;

class FasilitasCardRepository
{
    public function getData()
    {
        return FasilitasCardModel::all();
    }

    public function find($id)
    {
        return FasilitasCardModel::findOrFail($id);
    }

    public function store($data)
    {
        return FasilitasCardModel::create($data);
    }

    public function update($id, $data)
    {
        $card = FasilitasCardModel::findOrFail($id);
        $card->update($data);
        return $card;
    }

    public function delete($id)
    {
        $card = FasilitasCardModel::findOrFail($id);
        return $card->delete();
    }
}

