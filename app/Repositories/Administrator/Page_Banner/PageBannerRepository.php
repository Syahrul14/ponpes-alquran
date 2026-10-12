<?php

namespace App\Repositories\Administrator\Page_Banner;

use App\Models\Administrator\Page_Banner\PageBannerModel;

class PageBannerRepository
{
    public function getData()
    {
        return PageBannerModel::all();
    }

    public function find($id)
    {
        return PageBannerModel::findOrFail($id);
    }

    public function store($data)
    {
        return PageBannerModel::create($data);
    }

    public function update($id, $data)
    {
        $banner = PageBannerModel::findOrFail($id);
        $banner->update($data);
        return $banner;
    }

    public function delete($id)
    {
        $banner = PageBannerModel::findOrFail($id);
        return $banner->delete();
    }
}

