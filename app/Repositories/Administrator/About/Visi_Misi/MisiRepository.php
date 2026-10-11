<?php

namespace App\Repositories\Administrator\About\Visi_Misi;

use App\Models\Administrator\About\Visi_Misi\MisiModel;

class MisiRepository
{
    public function getData()
    {
        return MisiModel::all();
    }

    public function find($id)
    {
        return MisiModel::findOrFail($id);
    }

    public function store($data)
    {
        return MisiModel::create($data);
    }

    public function update($id, $data)
    {
        $misi = MisiModel::findOrFail($id);
        $misi->update($data);
        return $misi;
    }

    public function delete($id)
    {
        $misi = MisiModel::findOrFail($id);
        return $misi->delete();
    }
}

