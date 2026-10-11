<?php

namespace App\Repositories\Administrator\Home;

use App\Models\Administrator\Home\HomeAlumniModel;

class HomeAlumniRepository
{
    public function getData()
    {
        return HomeAlumniModel::all();
    }

    public function find($id)
    {
        return HomeAlumniModel::findOrFail($id);
    }

    public function store($data)
    {
        return HomeAlumniModel::create($data);
    }

    public function update($id, $data)
    {
        $alumni = HomeAlumniModel::findOrFail($id);
        $alumni->update($data);
        return $alumni;
    }

    public function delete($id)
    {
        $alumni = HomeAlumniModel::findOrFail($id);
        return $alumni->delete();
    }
}

