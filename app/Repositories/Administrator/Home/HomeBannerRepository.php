<?php

namespace App\Repositories\Administrator\Home;

use App\Models\Administrator\Home\HomeBannerModel;

class HomeBannerRepository
{
    public function getData()
    {
        $data = HomeBannerModel::all();
        return $data;
    }

    public function find($id)
    {
        return HomeBannerModel::findOrFail($id);
    }

    public function store($data)
    {
        return HomeBannerModel::create($data);
    }

    public function update($id, $data)
    {
        $banner = HomeBannerModel::findOrFail($id);
        $banner->update($data);
        return $banner;
    }

    public function delete($id)
    {
        $banner = HomeBannerModel::findOrFail($id);
        return $banner->delete();
    }
}