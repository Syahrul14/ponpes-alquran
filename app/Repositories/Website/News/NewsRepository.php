<?php

namespace App\Repositories\Website\News;

use App\Models\Administrator\Information\News\NewsModel;

class NewsRepository
{
    public function getNewsList()
    {
        return NewsModel::orderBy('created_at', 'desc')->get();
    }

    public function getNewsBySlug($slug)
    {
        return NewsModel::where('slug', $slug)->firstOrFail();
    }

    public function getRecentNews($currentId, $limit = 3)
    {
        return NewsModel::where('id', '!=', $currentId)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}

