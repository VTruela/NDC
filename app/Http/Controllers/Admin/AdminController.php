<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\Contracts\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        $stats = [
            'products' => Product::count(),
            'categories' => Category::count(),
            'articles' => Article::count(),
            'testimonials' => Testimonial::count(),
            'unread' => ContactMessage::unread()->count(),
        ];

        return view('admin.dashboard', [
            'stats' => $stats,
            'latestMessages' => ContactMessage::latest()->take(5)->get(),
            'latestProducts' => Product::with('category')->latest()->take(5)->get(),
        ]);
    }
}
