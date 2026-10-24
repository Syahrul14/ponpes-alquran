<?php

namespace App\Repositories\Website\Infaq;

use App\Models\Administrator\Infaq\InfaqBankTransferModel;

class InfaqRepository
{
    public function getBankTransfers()
    {
        return InfaqBankTransferModel::all();
    }
}

