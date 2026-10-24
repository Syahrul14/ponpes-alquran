<?php

namespace App\Repositories\Administrator\Information\Informasi;

use App\Models\Administrator\Information\Informasi\InformasiModel;

class InformasiRepository
{
    public function getData()
    {
        return InformasiModel::orderBy('created_at', 'desc')->get();
    }

    public function find($id)
    {
        return InformasiModel::findOrFail($id);
    }

    public function findBySlug($slug)
    {
        return InformasiModel::where('slug', $slug)->firstOrFail();
    }

    public function store($data)
    {
        return InformasiModel::create($data);
    }

    public function update($id, $data)
    {
        $informasi = InformasiModel::findOrFail($id);
        $informasi->update($data);
        return $informasi;
    }

    public function delete($id)
    {
        $informasi = InformasiModel::findOrFail($id);
        return $informasi->delete();
    }
}

