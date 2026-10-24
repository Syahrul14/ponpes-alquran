<?php

namespace App\Models\Administrator\Infaq;

use Illuminate\Database\Eloquent\Model;

class InfaqBankTransferModel extends Model
{
    protected $table = 'infaq_bank_transfer';

    protected $fillable = [
        'logo_bank',
        'bank_name',
        'account_name',
        'account_number',
    ];
}

