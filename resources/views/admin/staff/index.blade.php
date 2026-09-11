@extends('layouts.admin')

@section('title', 'Staff')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Staff</h1>
    <a href="{{ route('admin.staff.create') }}" class="btn btn-accent"><i class="bi bi-plus-lg"></i> Add Staff</a>
</div>
<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0 admin-datatable">
            <thead><tr><th>Photo</th><th>Name</th><th>Role</th><th>City</th><th>Phone</th><th>Monthly Salary</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
                @foreach($staffMembers as $staff)
                    <tr>
                        <td><img src="@media($staff->photo)" height="36" width="36" class="rounded-circle object-fit-cover" alt="" onerror="this.src='{{ asset('images/logo-icon.png') }}'"></td>
                        <td>{{ $staff->name }}</td>
                        <td>{{ $staff->role ?? '—' }}</td>
                        <td>{{ $staff->city ?? '—' }}{{ $staff->state ? ', '.$staff->state : '' }}</td>
                        <td>{{ $staff->phone ?? '—' }}</td>
                        <td>₹{{ number_format($staff->monthly_salary, 2) }}</td>
                        <td><span class="badge bg-{{ $staff->is_active ? 'success' : 'secondary' }}">{{ $staff->is_active ? 'Active' : 'Inactive' }}</span></td>
                        <td>
                            <a href="{{ route('admin.staff.edit', $staff) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('admin.staff.destroy', $staff) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Delete</button></form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
