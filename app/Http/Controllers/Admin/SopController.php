<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\StoresPublicImages;
use App\Http\Controllers\Controller;
use App\Models\Sop;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SopController extends Controller
{
    use StoresPublicImages;

    public function index(): View
    {
        $sops = Sop::query()
            ->orderBy('category')
            ->orderBy('title')
            ->get();

        return view('admin.sops.index', compact('sops'));
    }

    public function create(): View
    {
        return view('admin.sops.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'content' => ['nullable', 'string'],
            'document' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:10240'],
            'version' => ['nullable', 'string', 'max:20'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('document')) {
            $validated['document'] = $this->storePublicImage($request->file('document'), 'sops');
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['version'] = $validated['version'] ?? '1.0';

        Sop::query()->create($validated);

        return redirect()
            ->route('admin.sops.index')
            ->with('success', 'SOP created successfully.');
    }

    public function show(Sop $sop): View
    {
        return view('admin.sops.show', compact('sop'));
    }

    public function edit(Sop $sop): View
    {
        return view('admin.sops.edit', compact('sop'));
    }

    public function update(Request $request, Sop $sop): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'content' => ['nullable', 'string'],
            'document' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:10240'],
            'version' => ['nullable', 'string', 'max:20'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('document')) {
            $this->deletePublicImage($sop->document);
            $validated['document'] = $this->storePublicImage($request->file('document'), 'sops');
        }

        $validated['is_active'] = $request->boolean('is_active');

        $sop->update($validated);

        return redirect()
            ->route('admin.sops.index')
            ->with('success', 'SOP updated successfully.');
    }

    public function destroy(Sop $sop): RedirectResponse
    {
        $this->deletePublicImage($sop->document);
        $sop->delete();

        return redirect()
            ->route('admin.sops.index')
            ->with('success', 'SOP deleted successfully.');
    }
}
