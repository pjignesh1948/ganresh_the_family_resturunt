<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\StoresPublicImages;
use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PromotionController extends Controller
{
    use StoresPublicImages;

    public function index(): View
    {
        return view('admin.promotions.index', [
            'promotions' => Promotion::latest()->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.promotions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|max:4096',
            'link' => 'nullable|url|max:500',
            'is_active' => 'nullable|boolean',
            'show_once' => 'nullable|boolean',
        ]);
        $data['image'] = $this->storePublicImage($request->file('image'), 'promotions');
        $data['is_active'] = $request->boolean('is_active', true);
        $data['show_once'] = $request->boolean('show_once', true);
        Promotion::create($data);

        return redirect()->route('admin.promotions.index')->with('success', 'Promotion saved.');
    }

    public function edit(Promotion $promotion): View
    {
        return view('admin.promotions.edit', compact('promotion'));
    }

    public function update(Request $request, Promotion $promotion): RedirectResponse
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:4096',
            'link' => 'nullable|url|max:500',
            'is_active' => 'nullable|boolean',
            'show_once' => 'nullable|boolean',
        ]);
        if ($request->hasFile('image')) {
            $this->deletePublicImage($promotion->image);
            $data['image'] = $this->storePublicImage($request->file('image'), 'promotions');
        }
        $data['is_active'] = $request->boolean('is_active');
        $data['show_once'] = $request->boolean('show_once');
        $promotion->update($data);

        return redirect()->route('admin.promotions.index')->with('success', 'Promotion updated.');
    }

    public function destroy(Promotion $promotion): RedirectResponse
    {
        $this->deletePublicImage($promotion->image);
        $promotion->delete();

        return redirect()->route('admin.promotions.index')->with('success', 'Promotion deleted.');
    }
}
