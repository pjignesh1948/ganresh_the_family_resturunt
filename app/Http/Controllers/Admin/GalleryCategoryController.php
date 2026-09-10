<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryCategoryController extends Controller
{
    public function index(): View
    {
        $categories = GalleryCategory::query()
            ->withCount('galleryImages')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.gallery-categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.gallery-categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        GalleryCategory::query()->create($validated);

        return redirect()
            ->route('admin.gallery-categories.index')
            ->with('success', 'Gallery category created successfully.');
    }

    public function show(GalleryCategory $galleryCategory): View
    {
        $galleryCategory->load('galleryImages');

        return view('admin.gallery-categories.show', compact('galleryCategory'));
    }

    public function edit(GalleryCategory $galleryCategory): View
    {
        return view('admin.gallery-categories.edit', compact('galleryCategory'));
    }

    public function update(Request $request, GalleryCategory $galleryCategory): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $galleryCategory->update($validated);

        return redirect()
            ->route('admin.gallery-categories.index')
            ->with('success', 'Gallery category updated successfully.');
    }

    public function destroy(GalleryCategory $galleryCategory): RedirectResponse
    {
        $galleryCategory->delete();

        return redirect()
            ->route('admin.gallery-categories.index')
            ->with('success', 'Gallery category deleted successfully.');
    }
}
