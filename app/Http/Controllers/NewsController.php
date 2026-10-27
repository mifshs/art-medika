<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Список всех новостей (с пагинацией)
     */
    public function index(Request $request)
    {
        $news = News::query()
            ->published()
            ->with(['category', 'author', 'media'])
            ->orderByRaw('published_at IS NULL, published_at DESC, id DESC')
            ->paginate(10);

        return view('news', compact('news'));
    }

    /**
     * Страница отдельной новости
     */
    public function show(News $news, Request $request)
    {
        abort_unless($news->is_active, 404);

        $news->load(['media', 'category', 'author']);

        // Каталог других новостей внизу страницы (по 4 карточки на десктопе)
        $otherNews = News::query()
            ->published()
            ->where('id', '!=', $news->id)
            ->with(['media', 'category', 'author'])
            ->orderByRaw('published_at IS NULL, published_at DESC, id DESC')
            ->paginate(4);

        return view('news-detail', compact('news', 'otherNews'));
    }
}
