<?php

namespace App\Repositories\Administrator\About\History;

use App\Models\Administrator\About\History\HistoryProfileModel;

class HistoryProfileRepository
{
    public function getData()
    {
        return HistoryProfileModel::all();
    }

    public function find($id)
    {
        return HistoryProfileModel::findOrFail($id);
    }

    public function store($data)
    {
        return HistoryProfileModel::create($data);
    }

    public function update($id, $data)
    {
        $profile = HistoryProfileModel::findOrFail($id);
        $profile->update($data);
        return $profile;
    }

    public function delete($id)
    {
        $profile = HistoryProfileModel::findOrFail($id);
        return $profile->delete();
    }
}

