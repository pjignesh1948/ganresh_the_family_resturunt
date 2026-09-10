<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\StoresPublicImages;
use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    use StoresPublicImages;

    public function index(): View
    {
        $portfolios = Portfolio::query()
            ->orderBy('sort_order')
            ->latest()
            ->get();

        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function create(): View
    {
        return view('admin.portfolios.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
            'event_date' => ['nullable', 'date'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->storePublicImage($request->file('image'), 'portfolios');
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Portfolio::query()->create($validated);

        return redirect()
            ->route('admin.portfolios.index')
            ->with('success', 'Portfolio item created successfully.');
    }

    public function show(Portfolio $portfolio): View
    {
        return view('admin.portfolios.show', compact('portfolio'));
    }

    public function edit(Portfolio $portfolio): View
    {
        return view('admin.portfolios.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
            'event_date' => ['nullable', 'date'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $this->deletePublicImage($portfolio->image);
            $validated['image'] = $this->storePublicImage($request->file('image'), 'portfolios');
        }

        $validated['is_active'] = $request->boolean('is_active');

        $portfolio->update($validated);

        return redirect()
            ->route('admin.portfolios.index')
            ->with('success', 'Portfolio item updated successfully.');
    }

    public function destroy(Portfolio $portfolio): RedirectResponse
    {
        $this->deletePublicImage($portfolio->image);
        $portfolio->delete();

        return redirect()
            ->route('admin.portfolios.index')
            ->with('success', 'Portfolio item deleted successfully.');
    }
}
