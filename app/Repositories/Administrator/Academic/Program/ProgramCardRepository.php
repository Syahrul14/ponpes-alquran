<?php

namespace App\Repositories\Administrator\Academic\Program;

use App\Models\Administrator\Academic\Program\ProgramCardModel;

class ProgramCardRepository
{
    public function getData()
    {
        return ProgramCardModel::all();
    }

    public function find($id)
    {
        return ProgramCardModel::findOrFail($id);
    }

    public function store($data)
    {
        return ProgramCardModel::create($data);
    }

    public function update($id, $data)
    {
        $card = ProgramCardModel::findOrFail($id);
        $card->update($data);
        return $card;
    }

    public function delete($id)
    {
        $card = ProgramCardModel::findOrFail($id);
        return $card->delete();
    }
}

