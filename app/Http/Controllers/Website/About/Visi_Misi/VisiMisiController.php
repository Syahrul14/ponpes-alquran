<?php

namespace App\Http\Controllers\Website\About\Visi_Misi;

use App\Http\Controllers\Controller;
use App\Repositories\Website\About\Visi_Misi\VisiMisiRepository;

class VisiMisiController extends Controller
{
    protected $visiMisiRepository;

    public function __construct(VisiMisiRepository $visiMisiRepository)
    {
        $this->visiMisiRepository = $visiMisiRepository;
    }

    public function index()
    {
        $data = $this->visiMisiRepository->getVisiMisiContent();

        return view('website.about.visi_misi_content', compact('data'));
    }
}

