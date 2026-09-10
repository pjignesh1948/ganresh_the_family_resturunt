<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\StoresPublicImages;
use App\Http\Controllers\Controller;
use App\Models\MenuCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuCategoryController extends Controller
{
    use StoresPublicImages;

    public function index(): View
    {
        $categories = MenuCategory::query()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.menu-categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.menu-categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->storePublicImage($request->file('image'), 'menu/categories');
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        MenuCategory::query()->create($validated);

        return redirect()
            ->route('admin.menu-categories.index')
            ->with('success', 'Menu category created successfully.');
    }

    public function show(MenuCategory $menuCategory): View
    {
        $menuCategory->load('menuItems');

        return view('admin.menu-categories.show', compact('menuCategory'));
    }

    public function edit(MenuCategory $menuCategory): View
    {
        return view('admin.menu-categories.edit', compact('menuCategory'));
    }

    public function update(Request $request, MenuCategory $menuCategory): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $this->deletePublicImage($menuCategory->image);
            $validated['image'] = $this->storePublicImage($request->file('image'), 'menu/categories');
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? $menuCategory->sort_order;

        $menuCategory->update($validated);

        return redirect()
            ->route('admin.menu-categories.index')
            ->with('success', 'Menu category updated successfully.');
    }

    public function destroy(MenuCategory $menuCategory): RedirectResponse
    {
        $this->deletePublicImage($menuCategory->image);
        $menuCategory->delete();

        return redirect()
            ->route('admin.menu-categories.index')
            ->with('success', 'Menu category deleted successfully.');
    }
}
