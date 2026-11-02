<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        return view('pages.articles.index', [
            'articles' => Article::published()->latest('published_at')->paginate(6),
            'latest' => Article::published()->latest('published_at')->take(4)->get(),
        ]);
    }

    public function show(string $slug): View
    {
        $article = Article::published()->where('slug', $slug)->firstOrFail();

        return view('pages.articles.show', [
            'article' => $article,
            'related' => Article::published()
                ->where('id', '!=', $article->id)
                ->latest('published_at')
                ->take(3)
                ->get(),
        ]);
    }
}
