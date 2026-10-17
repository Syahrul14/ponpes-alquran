<?php

namespace App\Models\Administrator\Information\News;

use Illuminate\Database\Eloquent\Model;

class NewsModel extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'image',
        'title',
        'slug',
        'content',
    ];
}

