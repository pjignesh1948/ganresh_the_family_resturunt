<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VideoCategoryController extends Controller
{
    public function index(): View
    {
        $categories = VideoCategory::query()
            ->withCount('videos')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.video-categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.video-categories.create');
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

        VideoCategory::query()->create($validated);

        return redirect()
            ->route('admin.video-categories.index')
            ->with('success', 'Video category created successfully.');
    }

    public function show(VideoCategory $videoCategory): View
    {
        $videoCategory->load('videos');

        return view('admin.video-categories.show', compact('videoCategory'));
    }

    public function edit(VideoCategory $videoCategory): View
    {
        return view('admin.video-categories.edit', compact('videoCategory'));
    }

    public function update(Request $request, VideoCategory $videoCategory): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $videoCategory->update($validated);

        return redirect()
            ->route('admin.video-categories.index')
            ->with('success', 'Video category updated successfully.');
    }

    public function destroy(VideoCategory $videoCategory): RedirectResponse
    {
        $videoCategory->delete();

        return redirect()
            ->route('admin.video-categories.index')
            ->with('success', 'Video category deleted successfully.');
    }
}
