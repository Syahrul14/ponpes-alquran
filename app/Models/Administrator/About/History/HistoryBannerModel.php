<?php

namespace App\Models\Administrator\About\History;

use Illuminate\Database\Eloquent\Model;

class HistoryBannerModel extends Model
{
    protected $table = 'history_banner';

    protected $fillable = [
        'image',
        'title',
        'sub_title',
    ];
}
