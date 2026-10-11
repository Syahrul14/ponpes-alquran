<?php

namespace App\Models\Administrator\About\Visi_Misi;

use Illuminate\Database\Eloquent\Model;

class VisiModel extends Model
{
    protected $table = 'visimisi_visi';

    protected $fillable = [
        'title',
        'description',
    ];
}

