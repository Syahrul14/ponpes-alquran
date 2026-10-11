<?php

namespace App\Repositories\Administrator\About\Visi_Misi;

use App\Models\Administrator\About\Visi_Misi\VisiModel;

class VisiRepository
{
    public function getData()
    {
        return VisiModel::all();
    }

    public function find($id)
    {
        return VisiModel::findOrFail($id);
    }

    public function store($data)
    {
        return VisiModel::create($data);
    }

    public function update($id, $data)
    {
        $visi = VisiModel::findOrFail($id);
        $visi->update($data);
        return $visi;
    }

    public function delete($id)
    {
        $visi = VisiModel::findOrFail($id);
        return $visi->delete();
    }
}

