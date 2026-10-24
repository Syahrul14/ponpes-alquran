<?php

namespace App\Models\Administrator\Contact;

use Illuminate\Database\Eloquent\Model;

class ContactInfoModel extends Model
{
    protected $table = 'contact_info';

    protected $fillable = [
        'address',
        'phone',
        'email',
        'opening_hours',
        'maps_iframe',
    ];
}

