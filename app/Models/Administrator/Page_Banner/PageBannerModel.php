<?php

namespace App\Models\Administrator\Page_Banner;

use Illuminate\Database\Eloquent\Model;

class PageBannerModel extends Model
{
    protected $table = 'page_banner';

    protected $fillable = [
        'image',
    ];
}

