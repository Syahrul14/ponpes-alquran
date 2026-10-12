<?php

namespace App\Repositories\Website\Program;

use App\Models\Administrator\Academic\Program\ProgramCardModel;

class ProgramRepository
{
    public function getProgramContent()
    {
        return [
            'program_cards' => $this->cmsProgramCards(),
        ];
    }

    public function cmsProgramCards()
    {
        return ProgramCardModel::all();
    }
}

