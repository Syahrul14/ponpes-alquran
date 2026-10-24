<?php

namespace App\Http\Controllers\Website\Informasi;

use App\Http\Controllers\Controller;
use App\Repositories\Website\Informasi\InformasiRepository;

class InformasiController extends Controller
{
    protected $informasiRepository;

    public function __construct(InformasiRepository $informasiRepository)
    {
        $this->informasiRepository = $informasiRepository;
    }

    public function index()
    {
        $informasiList = $this->informasiRepository->getInformasiList();

        return view('website.informasi.informasi_content', compact('informasiList'));
    }

    public function detail($slug)
    {
        $informasi = $this->informasiRepository->getInformasiBySlug($slug);
        $recentInformasi = $this->informasiRepository->getRecentInformasi($informasi->id, 3);

        return view('website.informasi.informasi_detail_content', compact('informasi', 'recentInformasi'));
    }
}

