<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\StoresPublicImages;
use App\Http\Controllers\Controller;
use App\Models\Founder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FounderController extends Controller
{
    use StoresPublicImages;

    public function index(): View
    {
        return view('admin.founders.index', [
            'founders' => Founder::orderBy('sort_order')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.founders.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:120',
            'title' => 'nullable|string|max:120',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);
        if ($request->hasFile('photo')) {
            $data['photo'] = $this->storePublicImage($request->file('photo'), 'founders');
        }
        $data['is_active'] = $request->boolean('is_active', true);
        Founder::create($data);

        return redirect()->route('admin.founders.index')->with('success', 'Founder added.');
    }

    public function edit(Founder $founder): View
    {
        return view('admin.founders.edit', compact('founder'));
    }

    public function update(Request $request, Founder $founder): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:120',
            'title' => 'nullable|string|max:120',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);
        if ($request->hasFile('photo')) {
            $this->deletePublicImage($founder->photo);
            $data['photo'] = $this->storePublicImage($request->file('photo'), 'founders');
        }
        $data['is_active'] = $request->boolean('is_active');
        $founder->update($data);

        return redirect()->route('admin.founders.index')->with('success', 'Founder updated.');
    }

    public function destroy(Founder $founder): RedirectResponse
    {
        $this->deletePublicImage($founder->photo);
        $founder->delete();

        return redirect()->route('admin.founders.index')->with('success', 'Founder removed.');
    }
}
