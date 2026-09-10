@extends('layouts.admin')

@section('title', 'Video Categories')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Video Categories</h1>
    <a href="{{ route('admin.video-categories.create') }}" class="btn btn-maroon"><i class="bi bi-plus-lg"></i> Add Category</a>
</div>
<div class="card shadow-sm">
    <div class="table-responsive"><table class="table table-hover mb-0 admin-datatable"><thead><tr><th>Name</th><th>Videos</th><th>Sort</th><th>Status</th><th>Actions</th></tr></thead>
    <tbody>@forelse($categories as $category)<tr><td>{{ $category->name }}</td><td>{{ $category->videos_count }}</td><td>{{ $category->sort_order }}</td><td><span class="badge bg-{{ $category->is_active ? 'success' : 'secondary' }}">{{ $category->is_active ? 'Active' : 'Inactive' }}</span></td><td><a href="{{ route('admin.video-categories.show', $category) }}" class="btn btn-sm btn-outline-secondary">View</a> <a href="{{ route('admin.video-categories.edit', $category) }}" class="btn btn-sm btn-outline-primary">Edit</a> <form action="{{ route('admin.video-categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Delete</button></form></td></tr>@empty<tr><td colspan="5" class="text-center text-muted py-4">No categories.</td></tr>@endforelse</tbody></table></div>
</div>
@endsection
