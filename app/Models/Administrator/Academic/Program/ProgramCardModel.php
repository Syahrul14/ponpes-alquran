<?php

namespace App\Models\Administrator\Academic\Program;

use Illuminate\Database\Eloquent\Model;

class ProgramCardModel extends Model
{
    protected $table = 'program_card';

    protected $fillable = [
        'image',
        'title',
        'description',
    ];
}

