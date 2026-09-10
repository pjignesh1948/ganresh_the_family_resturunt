<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\StoresPublicImages;
use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeamMemberController extends Controller
{
    use StoresPublicImages;

    public function index(): View
    {
        return view('admin.team-members.index', [
            'members' => TeamMember::orderBy('sort_order')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.team-members.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:120',
            'role' => 'nullable|string|max:120',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'phone' => 'nullable|string|max:20',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);
        if ($request->hasFile('photo')) {
            $data['photo'] = $this->storePublicImage($request->file('photo'), 'team');
        }
        $data['is_active'] = $request->boolean('is_active', true);
        TeamMember::create($data);

        return redirect()->route('admin.team-members.index')->with('success', 'Team member added.');
    }

    public function edit(TeamMember $teamMember): View
    {
        return view('admin.team-members.edit', ['member' => $teamMember]);
    }

    public function update(Request $request, TeamMember $teamMember): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:120',
            'role' => 'nullable|string|max:120',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'phone' => 'nullable|string|max:20',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);
        if ($request->hasFile('photo')) {
            $this->deletePublicImage($teamMember->photo);
            $data['photo'] = $this->storePublicImage($request->file('photo'), 'team');
        }
        $data['is_active'] = $request->boolean('is_active');
        $teamMember->update($data);

        return redirect()->route('admin.team-members.index')->with('success', 'Team member updated.');
    }

    public function destroy(TeamMember $teamMember): RedirectResponse
    {
        $this->deletePublicImage($teamMember->photo);
        $teamMember->delete();

        return redirect()->route('admin.team-members.index')->with('success', 'Team member removed.');
    }
}
