<?php

namespace App\Models\Administrator\Home;

use Illuminate\Database\Eloquent\Model;

class HomeProfileModel extends Model
{
    protected $table = 'home_profile';

    protected $fillable = [
        'image',
        'title',
        'description',
        'link',
    ];
}
