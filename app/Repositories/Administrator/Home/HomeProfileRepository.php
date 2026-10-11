<?php

namespace App\Repositories\Administrator\Home;

use App\Models\Administrator\Home\HomeProfileModel;

class HomeProfileRepository
{
    public function getData()
    {
        return HomeProfileModel::all();
    }

    public function find($id)
    {
        return HomeProfileModel::findOrFail($id);
    }

    public function store($data)
    {
        return HomeProfileModel::create($data);
    }

    public function update($id, $data)
    {
        $profile = HomeProfileModel::findOrFail($id);
        $profile->update($data);
        return $profile;
    }

    public function delete($id)
    {
        $profile = HomeProfileModel::findOrFail($id);
        return $profile->delete();
    }
}
