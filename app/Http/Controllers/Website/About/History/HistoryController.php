<?php

namespace App\Http\Controllers\Website\About\History;

use App\Http\Controllers\Controller;
use App\Repositories\Website\About\History\HistoryRepository;

class HistoryController extends Controller
{
    protected $historyRepository;

    public function __construct(HistoryRepository $historyRepository)
    {
        $this->historyRepository = $historyRepository;
    }

    public function index()
    {
        $data = $this->historyRepository->getHistoryContent();

        return view('website.about.history_content', compact('data'));
    }
}

