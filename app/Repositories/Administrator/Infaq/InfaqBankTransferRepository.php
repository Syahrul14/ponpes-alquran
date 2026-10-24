<?php

namespace App\Repositories\Administrator\Infaq;

use App\Models\Administrator\Infaq\InfaqBankTransferModel;

class InfaqBankTransferRepository
{
    public function getData()
    {
        return InfaqBankTransferModel::all();
    }

    public function find($id)
    {
        return InfaqBankTransferModel::findOrFail($id);
    }

    public function store($data)
    {
        return InfaqBankTransferModel::create($data);
    }

    public function update($id, $data)
    {
        $item = InfaqBankTransferModel::findOrFail($id);
        $item->update($data);
        return $item;
    }

    public function delete($id)
    {
        $item = InfaqBankTransferModel::findOrFail($id);
        return $item->delete();
    }
}

