<?php

namespace App\Models\Administrator\About\History;

use Illuminate\Database\Eloquent\Model;

class HistoryProfileModel extends Model
{
    protected $table = 'history_profile';

    protected $fillable = [
        'image',
        'title',
        'description',
        'quotes',
    ];
}

