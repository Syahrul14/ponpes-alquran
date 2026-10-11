<?php

namespace App\Models\Administrator\Home;

use Illuminate\Database\Eloquent\Model;

class HomeBannerModel extends Model
{
    protected $table = 'home_banner';

    protected $fillable = [
        'title',
        'sub_title',
        'link',
        'image_1',
        'image_2',
        'image_3',
    ];
}
