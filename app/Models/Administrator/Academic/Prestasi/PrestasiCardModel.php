<?php

namespace App\Models\Administrator\Academic\Prestasi;

use Illuminate\Database\Eloquent\Model;

class PrestasiCardModel extends Model
{
    protected $table = 'prestasi_card';

    protected $fillable = [
        'image',
        'title',
        'description',
    ];
}

