<?php

namespace App\Repositories\Website\Infaq;

use App\Models\Administrator\Infaq\InfaqBankTransferModel;
use App\Models\Administrator\Infaq\InfaqQrisModel;

class InfaqRepository
{
    public function getBankTransfers()
    {
        return InfaqBankTransferModel::all();
    }

    public function getQris()
    {
        return InfaqQrisModel::first();
    }
}
