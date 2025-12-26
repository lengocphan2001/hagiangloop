<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of published news.
     */
    public function index()
    {
        $news = News::published()
                    ->orderBy('sort_order')
                    ->orderBy('published_at', 'desc')
                    ->paginate(12);

        return view('news.index', compact('news'));
    }

    /**
     * Display the specified news.
     */
    public function show($slug)
    {
        $newsItem = News::where('slug', $slug)
                        ->published()
                        ->firstOrFail();

        // Increment views
        $newsItem->increment('views');

        // Get related news
        $relatedNews = News::published()
                          ->where('id', '!=', $newsItem->id)
                          ->inRandomOrder()
                          ->limit(3)
                          ->get();

        return view('news.show', compact('newsItem', 'relatedNews'));
    }
}
