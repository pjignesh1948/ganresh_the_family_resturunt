<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\StoresPublicImages;
use App\Http\Controllers\Controller;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuItemController extends Controller
{
    use StoresPublicImages;

    public function index(): View
    {
        $menuItems = MenuItem::query()
            ->with('menuCategory')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.menu-items.index', compact('menuItems'));
    }

    public function create(): View
    {
        $categories = MenuCategory::query()->orderBy('name')->get();

        return view('admin.menu-items.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'menu_category_id' => ['required', 'exists:menu_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:5120'],
            'is_veg' => ['nullable', 'boolean'],
            'is_available' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->storePublicImage($request->file('image'), 'menu/items');
        }

        $validated['is_veg'] = $request->boolean('is_veg', true);
        $validated['is_available'] = $request->boolean('is_available', true);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        MenuItem::query()->create($validated);

        return redirect()
            ->route('admin.menu-items.index')
            ->with('success', 'Menu item created successfully.');
    }

    public function show(MenuItem $menuItem): View
    {
        $menuItem->load('menuCategory');

        return view('admin.menu-items.show', compact('menuItem'));
    }

    public function edit(MenuItem $menuItem): View
    {
        $categories = MenuCategory::query()->orderBy('name')->get();

        return view('admin.menu-items.edit', compact('menuItem', 'categories'));
    }

    public function update(Request $request, MenuItem $menuItem): RedirectResponse
    {
        $validated = $request->validate([
            'menu_category_id' => ['required', 'exists:menu_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:5120'],
            'is_veg' => ['nullable', 'boolean'],
            'is_available' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('image')) {
            $this->deletePublicImage($menuItem->image);
            $validated['image'] = $this->storePublicImage($request->file('image'), 'menu/items');
        }

        $validated['is_veg'] = $request->boolean('is_veg');
        $validated['is_available'] = $request->boolean('is_available');

        $menuItem->update($validated);

        return redirect()
            ->route('admin.menu-items.index')
            ->with('success', 'Menu item updated successfully.');
    }

    public function destroy(MenuItem $menuItem): RedirectResponse
    {
        $this->deletePublicImage($menuItem->image);
        $menuItem->delete();

        return redirect()
            ->route('admin.menu-items.index')
            ->with('success', 'Menu item deleted successfully.');
    }
}
