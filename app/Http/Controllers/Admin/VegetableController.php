<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\StoresPublicImages;
use App\Http\Controllers\Controller;
use App\Models\Vegetable;
use App\Models\VegetablePriceLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VegetableController extends Controller
{
    use StoresPublicImages;

    public function index(): View
    {
        $vegetables = Vegetable::query()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.vegetables.index', compact('vegetables'));
    }

    public function create(): View
    {
        return view('admin.vegetables.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name_hi' => ['nullable', 'string', 'max:255'],
            'name_gu' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'description_hi' => ['nullable', 'string'],
            'description_gu' => ['nullable', 'string'],
            'type' => ['nullable', 'string', 'max:50'],
            'image' => ['nullable', 'image', 'max:2048'],
            'retail_price_per_kg' => ['required', 'numeric', 'min:0'],
            'vendor_price_per_kg' => ['nullable', 'numeric', 'min:0'],
            'unit' => ['nullable', 'string', 'max:20'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->storePublicImage($request->file('image'), 'vegetables');
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['type'] = $validated['type'] ?? 'vegetable';
        $validated['unit'] = $validated['unit'] ?? 'kg';

        $vegetable = Vegetable::query()->create($validated);

        $this->logPriceChange($vegetable, 'Initial price');

        return redirect()
            ->route('admin.vegetables.index')
            ->with('success', 'Vegetable created successfully.');
    }

    public function show(Vegetable $vegetable): View
    {
        $vegetable->load(['priceLogs' => fn ($query) => $query->latest()->limit(20)]);

        return view('admin.vegetables.show', compact('vegetable'));
    }

    public function edit(Vegetable $vegetable): View
    {
        return view('admin.vegetables.edit', compact('vegetable'));
    }

    public function update(Request $request, Vegetable $vegetable): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name_hi' => ['nullable', 'string', 'max:255'],
            'name_gu' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'description_hi' => ['nullable', 'string'],
            'description_gu' => ['nullable', 'string'],
            'type' => ['nullable', 'string', 'max:50'],
            'image' => ['nullable', 'image', 'max:2048'],
            'retail_price_per_kg' => ['required', 'numeric', 'min:0'],
            'vendor_price_per_kg' => ['nullable', 'numeric', 'min:0'],
            'unit' => ['nullable', 'string', 'max:20'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('image')) {
            $this->deletePublicImage($vegetable->image);
            $validated['image'] = $this->storePublicImage($request->file('image'), 'vegetables');
        }

        $validated['is_active'] = $request->boolean('is_active');

        $pricesChanged = $vegetable->retail_price_per_kg != $validated['retail_price_per_kg']
            || $vegetable->vendor_price_per_kg != ($validated['vendor_price_per_kg'] ?? null);

        $vegetable->update($validated);

        if ($pricesChanged) {
            $this->logPriceChange($vegetable->fresh(), 'Price updated');
        }

        return redirect()
            ->route('admin.vegetables.index')
            ->with('success', 'Vegetable updated successfully.');
    }

    public function destroy(Vegetable $vegetable): RedirectResponse
    {
        $this->deletePublicImage($vegetable->image);
        $vegetable->delete();

        return redirect()
            ->route('admin.vegetables.index')
            ->with('success', 'Vegetable deleted successfully.');
    }

    private function logPriceChange(Vegetable $vegetable, ?string $note = null): void
    {
        VegetablePriceLog::query()->create([
            'vegetable_id' => $vegetable->id,
            'retail_price_per_kg' => $vegetable->retail_price_per_kg,
            'vendor_price_per_kg' => $vegetable->vendor_price_per_kg,
            'logged_date' => now()->toDateString(),
            'changed_by' => auth()->id(),
            'note' => $note,
        ]);
    }
}
