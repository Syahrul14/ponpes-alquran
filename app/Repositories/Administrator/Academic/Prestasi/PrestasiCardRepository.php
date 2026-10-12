<?php

namespace App\Repositories\Administrator\Academic\Prestasi;

use App\Models\Administrator\Academic\Prestasi\PrestasiCardModel;

class PrestasiCardRepository
{
    public function getData()
    {
        return PrestasiCardModel::all();
    }

    public function find($id)
    {
        return PrestasiCardModel::findOrFail($id);
    }

    public function store($data)
    {
        return PrestasiCardModel::create($data);
    }

    public function update($id, $data)
    {
        $card = PrestasiCardModel::findOrFail($id);
        $card->update($data);
        return $card;
    }

    public function delete($id)
    {
        $card = PrestasiCardModel::findOrFail($id);
        return $card->delete();
    }
}

