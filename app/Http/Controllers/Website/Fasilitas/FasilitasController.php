<?php

namespace App\Http\Controllers\Website\Fasilitas;

use App\Http\Controllers\Controller;
use App\Repositories\Website\Fasilitas\FasilitasRepository;

class FasilitasController extends Controller
{
    protected $fasilitasRepository;

    public function __construct(FasilitasRepository $fasilitasRepository)
    {
        $this->fasilitasRepository = $fasilitasRepository;
    }

    public function index()
    {
        $data = $this->fasilitasRepository->getFasilitasContent();

        return view('website.fasilitas.fasilitas_content', compact('data'));
    }
}

