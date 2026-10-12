<?php

namespace App\Http\Controllers\Website\Prestasi;

use App\Http\Controllers\Controller;
use App\Repositories\Website\Prestasi\PrestasiRepository;

class PrestasiController extends Controller
{
    protected $prestasiRepository;

    public function __construct(PrestasiRepository $prestasiRepository)
    {
        $this->prestasiRepository = $prestasiRepository;
    }

    public function index()
    {
        $data = $this->prestasiRepository->getPrestasiContent();

        return view('website.prestasi.prestasi_content', compact('data'));
    }
}

