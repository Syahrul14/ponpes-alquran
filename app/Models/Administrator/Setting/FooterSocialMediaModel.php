<?php

namespace App\Models\Administrator\Setting;

use Illuminate\Database\Eloquent\Model;

class FooterSocialMediaModel extends Model
{
    protected $table = 'footer_social_media';

    protected $fillable = [
        'name',
        'image',
        'url',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}

