@extends('layouts.admin')

@section('title', 'Team Members')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0"><i class="bi bi-person-badge me-2" style="color: #818cf8;"></i>Team Members</h1>
    <a href="{{ route('admin.team-members.create') }}" class="btn btn-accent"><i class="bi bi-plus-lg"></i> Add Member</a>
</div>
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0 admin-datatable">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Phone</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($members as $member)
                    <tr>
                        <td>
                            @if($member->photo)
                                <img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->name }}" height="40" width="40" class="rounded-circle object-fit-cover">
                            @else
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-secondary bg-opacity-25" style="width:40px;height:40px;"><i class="bi bi-person text-muted"></i></span>
                            @endif
                        </td>
                        <td class="fw-semibold">{{ $member->name }}</td>
                        <td>{{ $member->role ?? '—' }}</td>
                        <td>{{ $member->phone ?? '—' }}</td>
                        <td>{{ $member->sort_order }}</td>
                        <td><span class="badge bg-{{ $member->is_active ? 'success' : 'secondary' }}">{{ $member->is_active ? 'Active' : 'Inactive' }}</span></td>
                        <td>
                            <a href="{{ route('admin.team-members.edit', $member) }}" class="btn btn-sm btn-outline-accent"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.team-members.destroy', $member) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this team member?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No team members found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
