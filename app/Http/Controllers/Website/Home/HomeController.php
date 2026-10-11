<?php

namespace App\Http\Controllers\Website\Home;

use App\Http\Controllers\Controller;
use App\Repositories\Website\Home\HomeRepository;

class HomeController extends Controller
{
    protected $homeRepository;

    public function __construct(HomeRepository $homeRepository)
    {
        $this->homeRepository = $homeRepository;
    }

    public function index()
    {
        $data = $this->homeRepository->getHomeContent();
        
        return view('website.home.home_content', compact('data'));
    }
}
