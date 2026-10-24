<?php

namespace App\Http\Controllers\Website\Infaq;

use App\Http\Controllers\Controller;
use App\Repositories\Website\Infaq\InfaqRepository;

class InfaqController extends Controller
{
    protected $infaqRepository;

    public function __construct(InfaqRepository $infaqRepository)
    {
        $this->infaqRepository = $infaqRepository;
    }

    public function index()
    {
        $bankTransfers = $this->infaqRepository->getBankTransfers();
        $qris = $this->infaqRepository->getQris();

        return view('website.infaq.infaq_content', compact('bankTransfers', 'qris'));
    }
}
