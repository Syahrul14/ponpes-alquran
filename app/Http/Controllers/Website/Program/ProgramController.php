<?php

namespace App\Http\Controllers\Website\Program;

use App\Http\Controllers\Controller;
use App\Repositories\Website\Program\ProgramRepository;

class ProgramController extends Controller
{
    protected $programRepository;

    public function __construct(ProgramRepository $programRepository)
    {
        $this->programRepository = $programRepository;
    }

    public function index()
    {
        $data = $this->programRepository->getProgramContent();

        return view('website.program.program_content', compact('data'));
    }
}

