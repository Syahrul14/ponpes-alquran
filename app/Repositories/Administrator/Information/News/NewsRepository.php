<?php

namespace App\Repositories\Administrator\Information\News;

use App\Models\Administrator\Information\News\NewsModel;

class NewsRepository
{
    public function getData()
    {
        return NewsModel::orderBy('created_at', 'desc')->get();
    }

    public function find($id)
    {
        return NewsModel::findOrFail($id);
    }

    public function findBySlug($slug)
    {
        return NewsModel::where('slug', $slug)->firstOrFail();
    }

    public function store($data)
    {
        return NewsModel::create($data);
    }

    public function update($id, $data)
    {
        $news = NewsModel::findOrFail($id);
        $news->update($data);
        return $news;
    }

    public function delete($id)
    {
        $news = NewsModel::findOrFail($id);
        return $news->delete();
    }
}

