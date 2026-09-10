<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    private const ALLOWED_SLUGS = ['home', 'about'];

    public function editHome(): View
    {
        return $this->editPage('home');
    }

    public function updateHome(Request $request): RedirectResponse
    {
        return $this->updatePage($request, 'home');
    }

    public function editAbout(): View
    {
        return $this->editPage('about');
    }

    public function updateAbout(Request $request): RedirectResponse
    {
        return $this->updatePage($request, 'about');
    }

    private function editPage(string $slug): View
    {
        $this->assertAllowedSlug($slug);

        $page = Page::query()->firstOrCreate(
            ['slug' => $slug],
            [
                'title' => ucfirst($slug),
                'is_published' => true,
            ]
        );

        return view('admin.pages.edit', compact('page'));
    }

    private function updatePage(Request $request, string $slug): RedirectResponse
    {
        $this->assertAllowedSlug($slug);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $validated['is_published'] = $request->boolean('is_published', true);

        $page = Page::query()->firstOrCreate(
            ['slug' => $slug],
            ['title' => ucfirst($slug)]
        );

        $page->update($validated);

        $route = $slug === 'home' ? 'admin.pages.home.edit' : 'admin.pages.about.edit';

        return redirect()
            ->route($route)
            ->with('success', ucfirst($slug) . ' page updated successfully.');
    }

    private function assertAllowedSlug(string $slug): void
    {
        if (! in_array($slug, self::ALLOWED_SLUGS, true)) {
            abort(404);
        }
    }
}
