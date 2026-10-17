<?php

namespace App\Http\Controllers\Website\News;

use App\Http\Controllers\Controller;
use App\Repositories\Website\News\NewsRepository;

class NewsController extends Controller
{
    protected $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function index()
    {
        $newsList = $this->newsRepository->getNewsList();

        return view('website.berita.berita_content', compact('newsList'));
    }

    public function detail($slug)
    {
        $news = $this->newsRepository->getNewsBySlug($slug);
        $recentNews = $this->newsRepository->getRecentNews($news->id, 3);

        return view('website.berita.berita_detail_content', compact('news', 'recentNews'));
    }
}

