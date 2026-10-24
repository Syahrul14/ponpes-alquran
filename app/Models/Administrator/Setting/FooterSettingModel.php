<?php

namespace App\Models\Administrator\Setting;

use Illuminate\Database\Eloquent\Model;

class FooterSettingModel extends Model
{
    protected $table = 'footer_settings';

    protected $fillable = [
        'logo',
        'pesantren_name',
        'about_text',
        'copyright_text',
    ];
}

