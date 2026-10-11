<?php

namespace App\Models\Administrator\Home;

use Illuminate\Database\Eloquent\Model;

class HomeAlumniModel extends Model
{
    protected $table = 'home_alumni';

    protected $fillable = [
        'image',
        'name',
        'current_position',
        'message',
    ];
}

