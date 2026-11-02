<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Contracts\View\View;

class TestimonialController extends Controller
{
    public function index(): View
    {
        return view('pages.testimonials', [
            'testimonials' => Testimonial::active()->latest()->get(),
            'averageRating' => round((float) Testimonial::active()->avg('rating'), 1),
        ]);
    }
}
