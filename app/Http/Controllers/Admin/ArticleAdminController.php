<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Support\ImageUpload;
use App\Support\Slug;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ArticleAdminController extends Controller
{
    public function index(): View
    {
        return view('admin.articles.index', [
            'articles' => Article::latest()->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('admin.articles.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = Slug::unique(Article::class, $data['title']);
        $data['image'] = ImageUpload::store($request->file('image'), 'articles');

        Article::create($data);

        return redirect()
            ->route('admin.articles.index')
            ->with('success', __('ui.admin.created'));
    }

    public function edit(Article $article): View
    {
        return view('admin.articles.edit', ['article' => $article]);
    }

    public function update(Request $request, Article $article): RedirectResponse
    {
        $data = $this->validated($request);

        if ($data['title'] !== $article->title) {
            $data['slug'] = Slug::unique(Article::class, $data['title'], $article->id);
        }

        $data['image'] = ImageUpload::store($request->file('image'), 'articles', $article->image);

        $article->update($data);

        return redirect()
            ->route('admin.articles.index')
            ->with('success', __('ui.admin.updated'));
    }

    public function destroy(Article $article): RedirectResponse
    {
        ImageUpload::delete($article->image);
        $article->delete();

        return back()->with('success', __('ui.admin.deleted'));
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'author' => ['nullable', 'string', 'max:100'],
            'published_at' => ['nullable', 'date'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $data['published_at'] ?? now();

        return $data;
    }
}
