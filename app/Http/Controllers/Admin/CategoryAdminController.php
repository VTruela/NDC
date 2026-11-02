<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Support\ImageUpload;
use App\Support\Slug;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryAdminController extends Controller
{
    public const THEMES = ['metal', 'institutional', 'laundry'];

    public function index(): View
    {
        return view('admin.categories.index', [
            'categories' => Category::withCount('products')->orderBy('name')->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('admin.categories.create', ['themes' => self::THEMES]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = Slug::unique(Category::class, $data['name']);
        $data['image'] = ImageUpload::store($request->file('image'), 'categories');

        Category::create($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', __('ui.admin.created'));
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', [
            'category' => $category,
            'themes' => self::THEMES,
        ]);
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $data = $this->validated($request);

        if ($data['name'] !== $category->name) {
            $data['slug'] = Slug::unique(Category::class, $data['name'], $category->id);
        }

        $data['image'] = ImageUpload::store($request->file('image'), 'categories', $category->image);

        $category->update($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', __('ui.admin.updated'));
    }

    public function destroy(Category $category): RedirectResponse
    {
        ImageUpload::delete($category->image);
        $category->delete();

        return back()->with('success', __('ui.admin.deleted'));
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'lang_id' => ['nullable', 'string', 'max:100'],
            'lang_en' => ['nullable', 'string', 'max:100'],
            'theme' => ['required', 'in:' . implode(',', self::THEMES)],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);
    }
}
