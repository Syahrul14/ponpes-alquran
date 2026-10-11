<?php

namespace App\Models\Administrator\About\Visi_Misi;

use Illuminate\Database\Eloquent\Model;

class MisiModel extends Model
{
    protected $table = 'visimisi_misi';

    protected $fillable = [
        'title',
        'description',
    ];
}

