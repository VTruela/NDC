<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        return view('pages.products.index', [
            'categories' => $this->categories(),
            'products' => Product::with('category')->active()->latest()->paginate(9),
            'activeCategory' => null,
        ]);
    }

    public function byCategory(Category $category): View
    {
        return view('pages.products.category', [
            'category' => $category,
            'categories' => $this->categories(),
            'products' => $category->products()->with('category')->active()->latest()->paginate(9),
            'activeCategory' => $category->slug,
        ]);
    }

    public function show(Category $category, string $slug): View
    {
        $product = $category->products()->active()->where('slug', $slug)->firstOrFail();

        return view('pages.products.show', [
            'category' => $category,
            'product' => $product,
            'categories' => $this->categories(),
            'related' => $category->products()
                ->active()
                ->where('id', '!=', $product->id)
                ->latest()
                ->take(3)
                ->get(),
        ]);
    }

    private function categories()
    {
        return Category::withCount([
            'products' => fn ($query) => $query->where('is_active', true),
        ])->get();
    }
}
