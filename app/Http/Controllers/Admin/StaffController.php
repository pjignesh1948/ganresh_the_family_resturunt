<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\StoresPublicImages;
use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StaffController extends Controller
{
    use StoresPublicImages;

    public function index(): View
    {
        $staffMembers = Staff::query()
            ->orderBy('name')
            ->get();

        return view('admin.staff.index', compact('staffMembers'));
    }

    public function create(): View
    {
        return view('admin.staff.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatedStaffData($request);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $this->storePublicImage($request->file('photo'), 'staff/photos');
        }

        if ($request->hasFile('aadhar_card')) {
            $validated['aadhar_card'] = $this->storePublicImage($request->file('aadhar_card'), 'staff/aadhar');
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['monthly_salary'] = $validated['monthly_salary'] ?? 0;

        Staff::query()->create($validated);

        return redirect()
            ->route('admin.staff.index')
            ->with('success', 'Staff member created successfully.');
    }

    public function show(Staff $staff): View
    {
        $staff->load(['salaryTransactions' => fn ($query) => $query->latest()->limit(20)]);

        return view('admin.staff.show', compact('staff'));
    }

    public function edit(Staff $staff): View
    {
        return view('admin.staff.edit', compact('staff'));
    }

    public function update(Request $request, Staff $staff): RedirectResponse
    {
        $validated = $this->validatedStaffData($request);

        if ($request->hasFile('photo')) {
            $this->deletePublicImage($staff->photo);
            $validated['photo'] = $this->storePublicImage($request->file('photo'), 'staff/photos');
        }

        if ($request->hasFile('aadhar_card')) {
            $this->deletePublicImage($staff->aadhar_card);
            $validated['aadhar_card'] = $this->storePublicImage($request->file('aadhar_card'), 'staff/aadhar');
        }

        $validated['is_active'] = $request->boolean('is_active');

        $staff->update($validated);

        return redirect()
            ->route('admin.staff.index')
            ->with('success', 'Staff member updated successfully.');
    }

    public function destroy(Staff $staff): RedirectResponse
    {
        $this->deletePublicImage($staff->photo);
        $this->deletePublicImage($staff->aadhar_card);
        $staff->delete();

        return redirect()
            ->route('admin.staff.index')
            ->with('success', 'Staff member deleted successfully.');
    }

    private function validatedStaffData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'role' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'city' => ['nullable', 'string', 'max:100'],
            'aadhar_number' => ['nullable', 'digits:12'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:5120'],
            'aadhar_card' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:5120'],
            'joining_date' => ['nullable', 'date'],
            'monthly_salary' => ['nullable', 'numeric', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'notes' => ['nullable', 'string'],
        ]);
    }
}
