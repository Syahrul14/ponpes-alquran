<?php

namespace App\Models\Administrator\Information\Informasi;

use Illuminate\Database\Eloquent\Model;

class InformasiModel extends Model
{
    protected $table = 'information';

    protected $fillable = [
        'image',
        'title',
        'slug',
        'content',
    ];
}

