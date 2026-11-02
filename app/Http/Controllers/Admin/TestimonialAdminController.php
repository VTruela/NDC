<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Support\ImageUpload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TestimonialAdminController extends Controller
{
    public function index(): View
    {
        return view('admin.testimonials.index', [
            'testimonials' => Testimonial::latest()->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['image'] = ImageUpload::store($request->file('image'), 'testimonials');

        Testimonial::create($data);

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', __('ui.admin.created'));
    }

    public function edit(Testimonial $testimonial): View
    {
        return view('admin.testimonials.edit', ['testimonial' => $testimonial]);
    }

    public function update(Request $request, Testimonial $testimonial): RedirectResponse
    {
        $data = $this->validated($request);
        $data['image'] = ImageUpload::store($request->file('image'), 'testimonials', $testimonial->image);

        $testimonial->update($data);

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', __('ui.admin.updated'));
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        ImageUpload::delete($testimonial->image);
        $testimonial->delete();

        return back()->with('success', __('ui.admin.deleted'));
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'company' => ['nullable', 'string', 'max:100'],
            'content' => ['required', 'string'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'image' => ['nullable', 'image', 'max:2048'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
