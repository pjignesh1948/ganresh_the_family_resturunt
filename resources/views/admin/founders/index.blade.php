@extends('layouts.admin')

@section('title', 'Founders')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">Founders</h1>
        <p class="text-muted small mb-0">Shown on the About Us page</p>
    </div>
    <a href="{{ route('admin.founders.create') }}" class="btn btn-accent"><i class="bi bi-plus-lg"></i> Add Founder</a>
</div>
<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0 admin-datatable">
            <thead><tr><th>Photo</th><th>Name</th><th>Title</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($founders as $founder)
                <tr>
                    <td>@if($founder->photo)<img src="@media($founder->photo)" height="44" width="44" class="rounded-circle object-fit-cover" alt="">@else—@endif</td>
                    <td>{{ $founder->name }}</td>
                    <td>{{ $founder->title ?? '—' }}</td>
                    <td><span class="badge bg-{{ $founder->is_active ? 'success' : 'secondary' }}">{{ $founder->is_active ? 'Active' : 'Inactive' }}</span></td>
                    <td>
                        <a href="{{ route('admin.founders.edit', $founder) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form action="{{ route('admin.founders.destroy', $founder) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Delete</button></form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-4">No founders yet. Add founders for the About page.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
