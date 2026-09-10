<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\StoresPublicImages;
use App\Http\Controllers\Controller;
use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryImageController extends Controller
{
    use StoresPublicImages;

    public function index(): View
    {
        $images = GalleryImage::query()
            ->with('galleryCategory')
            ->orderBy('sort_order')
            ->latest()
            ->get();

        return view('admin.gallery-images.index', compact('images'));
    }

    public function create(): View
    {
        $categories = GalleryCategory::query()->orderBy('name')->get();

        return view('admin.gallery-images.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'gallery_category_id' => ['nullable', 'exists:gallery_categories,id'],
            'title' => ['nullable', 'string', 'max:255'],
            'image' => ['required', 'image', 'max:4096'],
            'caption' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['image'] = $this->storePublicImage($request->file('image'), 'gallery');
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        GalleryImage::query()->create($validated);

        return redirect()
            ->route('admin.gallery-images.index')
            ->with('success', 'Gallery image uploaded successfully.');
    }

    public function show(GalleryImage $galleryImage): View
    {
        $galleryImage->load('galleryCategory');

        return view('admin.gallery-images.show', compact('galleryImage'));
    }

    public function edit(GalleryImage $galleryImage): View
    {
        $categories = GalleryCategory::query()->orderBy('name')->get();

        return view('admin.gallery-images.edit', compact('galleryImage', 'categories'));
    }

    public function update(Request $request, GalleryImage $galleryImage): RedirectResponse
    {
        $validated = $request->validate([
            'gallery_category_id' => ['nullable', 'exists:gallery_categories,id'],
            'title' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:4096'],
            'caption' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $this->deletePublicImage($galleryImage->image);
            $validated['image'] = $this->storePublicImage($request->file('image'), 'gallery');
        }

        $validated['is_active'] = $request->boolean('is_active');

        $galleryImage->update($validated);

        return redirect()
            ->route('admin.gallery-images.index')
            ->with('success', 'Gallery image updated successfully.');
    }

    public function destroy(GalleryImage $galleryImage): RedirectResponse
    {
        $this->deletePublicImage($galleryImage->image);
        $galleryImage->delete();

        return redirect()
            ->route('admin.gallery-images.index')
            ->with('success', 'Gallery image deleted successfully.');
    }
}
