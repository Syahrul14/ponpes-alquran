<?php

namespace App\Repositories\Website\Informasi;

use App\Models\Administrator\Information\Informasi\InformasiModel;

class InformasiRepository
{
    public function getInformasiList()
    {
        return InformasiModel::orderBy('created_at', 'desc')->get();
    }

    public function getInformasiBySlug($slug)
    {
        return InformasiModel::where('slug', $slug)->firstOrFail();
    }

    public function getRecentInformasi($currentId, $limit = 3)
    {
        return InformasiModel::where('id', '!=', $currentId)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}

