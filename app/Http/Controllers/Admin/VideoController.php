<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\StoresPublicImages;
use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\VideoCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VideoController extends Controller
{
    use StoresPublicImages;

    public function index(): View
    {
        $videos = Video::query()
            ->with('videoCategory')
            ->orderBy('sort_order')
            ->latest()
            ->get();

        return view('admin.videos.index', compact('videos'));
    }

    public function create(): View
    {
        $categories = VideoCategory::query()->orderBy('name')->get();

        return view('admin.videos.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'video_category_id' => ['nullable', 'exists:video_categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'youtube_url' => ['nullable', 'url', 'max:500'],
            'video_file' => ['nullable', 'file', 'mimes:mp4,webm,ogg', 'max:51200'],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('video_file')) {
            $validated['video_file'] = $this->storePublicImage($request->file('video_file'), 'videos');
        }

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $this->storePublicImage($request->file('thumbnail'), 'videos/thumbnails');
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Video::query()->create($validated);

        return redirect()
            ->route('admin.videos.index')
            ->with('success', 'Video created successfully.');
    }

    public function show(Video $video): View
    {
        $video->load('videoCategory');

        return view('admin.videos.show', compact('video'));
    }

    public function edit(Video $video): View
    {
        $categories = VideoCategory::query()->orderBy('name')->get();

        return view('admin.videos.edit', compact('video', 'categories'));
    }

    public function update(Request $request, Video $video): RedirectResponse
    {
        $validated = $request->validate([
            'video_category_id' => ['nullable', 'exists:video_categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'youtube_url' => ['nullable', 'url', 'max:500'],
            'video_file' => ['nullable', 'file', 'mimes:mp4,webm,ogg', 'max:51200'],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('video_file')) {
            $this->deletePublicImage($video->video_file);
            $validated['video_file'] = $this->storePublicImage($request->file('video_file'), 'videos');
        }

        if ($request->hasFile('thumbnail')) {
            $this->deletePublicImage($video->thumbnail);
            $validated['thumbnail'] = $this->storePublicImage($request->file('thumbnail'), 'videos/thumbnails');
        }

        $validated['is_active'] = $request->boolean('is_active');

        $video->update($validated);

        return redirect()
            ->route('admin.videos.index')
            ->with('success', 'Video updated successfully.');
    }

    public function destroy(Video $video): RedirectResponse
    {
        $this->deletePublicImage($video->video_file);
        $this->deletePublicImage($video->thumbnail);
        $video->delete();

        return redirect()
            ->route('admin.videos.index')
            ->with('success', 'Video deleted successfully.');
    }
}
