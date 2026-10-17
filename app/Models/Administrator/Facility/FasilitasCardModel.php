<?php

namespace App\Models\Administrator\Facility;

use Illuminate\Database\Eloquent\Model;

class FasilitasCardModel extends Model
{
    protected $table = 'fasilitas_card';

    protected $fillable = [
        'image',
        'title',
        'description',
    ];
}

