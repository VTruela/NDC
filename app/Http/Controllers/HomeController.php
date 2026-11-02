<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $categories = Category::withCount([
            'products' => fn ($query) => $query->where('is_active', true),
        ])->get();

        $featuredProducts = Product::with('category')
            ->active()
            ->featured()
            ->latest()
            ->take(6)
            ->get();

        $articles = Article::published()
            ->latest('published_at')
            ->take(3)
            ->get();

        $testimonials = Testimonial::active()
            ->latest()
            ->take(6)
            ->get();

        return view('pages.home', compact('categories', 'featuredProducts', 'articles', 'testimonials'));
    }

    public function about(): View
    {
        return view('pages.about', [
            'categories' => Category::withCount([
                'products' => fn ($query) => $query->where('is_active', true),
            ])->get(),
            'testimonials' => Testimonial::active()->latest()->take(3)->get(),
        ]);
    }
}
