<?php

namespace App\Models\Administrator\Contact;

use Illuminate\Database\Eloquent\Model;

class ContactMessageModel extends Model
{
    protected $table = 'contact_messages';

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];
}

