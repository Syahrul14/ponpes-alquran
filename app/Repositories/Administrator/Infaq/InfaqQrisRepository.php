<?php

namespace App\Repositories\Administrator\Infaq;

use App\Models\Administrator\Infaq\InfaqQrisModel;

class InfaqQrisRepository
{
    public function getData()
    {
        return InfaqQrisModel::first();
    }

    public function updateOrCreate($data)
    {
        $qris = InfaqQrisModel::first();
        if ($qris) {
            $qris->update($data);
            return $qris;
        }
        return InfaqQrisModel::create($data);
    }
}

