<?php

namespace App\Repositories\Administrator\About\History;

use App\Models\Administrator\About\History\HistoryBannerModel;

class HistoryBannerRepository
{
    public function getData()
    {
        return HistoryBannerModel::all();
    }

    public function find($id)
    {
        return HistoryBannerModel::findOrFail($id);
    }

    public function store($data)
    {
        return HistoryBannerModel::create($data);
    }

    public function update($id, $data)
    {
        $banner = HistoryBannerModel::findOrFail($id);
        $banner->update($data);
        return $banner;
    }

    public function delete($id)
    {
        $banner = HistoryBannerModel::findOrFail($id);
        return $banner->delete();
    }
}

