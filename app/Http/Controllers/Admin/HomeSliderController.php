<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\StoresPublicImages;
use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeSliderController extends Controller
{
    use StoresPublicImages;

    public function index(): View
    {
        return view('admin.home-sliders.index', [
            'sliders' => HomeSlider::orderBy('sort_order')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.home-sliders.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'image' => 'required|image|max:4096',
            'link' => 'nullable|url|max:500',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);
        $data['image'] = $this->storePublicImage($request->file('image'), 'sliders');
        $data['is_active'] = $request->boolean('is_active', true);
        HomeSlider::create($data);

        return redirect()->route('admin.home-sliders.index')->with('success', 'Slider added.');
    }

    public function edit(HomeSlider $homeSlider): View
    {
        return view('admin.home-sliders.edit', ['slider' => $homeSlider]);
    }

    public function update(Request $request, HomeSlider $homeSlider): RedirectResponse
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'image' => 'nullable|image|max:4096',
            'link' => 'nullable|url|max:500',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);
        if ($request->hasFile('image')) {
            $this->deletePublicImage($homeSlider->image);
            $data['image'] = $this->storePublicImage($request->file('image'), 'sliders');
        }
        $data['is_active'] = $request->boolean('is_active');
        $homeSlider->update($data);

        return redirect()->route('admin.home-sliders.index')->with('success', 'Slider updated.');
    }

    public function destroy(HomeSlider $homeSlider): RedirectResponse
    {
        $this->deletePublicImage($homeSlider->image);
        $homeSlider->delete();

        return redirect()->route('admin.home-sliders.index')->with('success', 'Slider deleted.');
    }
}
