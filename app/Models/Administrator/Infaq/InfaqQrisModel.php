<?php

namespace App\Models\Administrator\Infaq;

use Illuminate\Database\Eloquent\Model;

class InfaqQrisModel extends Model
{
    protected $table = 'infaq_qris';

    protected $fillable = [
        'image',
        'title',
        'description',
        'note',
    ];
}

