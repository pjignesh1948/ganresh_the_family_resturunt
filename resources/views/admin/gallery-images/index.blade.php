@extends('layouts.admin')

@section('title', 'Gallery Images')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Gallery Images</h1>
    <a href="{{ route('admin.gallery-images.create') }}" class="btn btn-maroon"><i class="bi bi-plus-lg"></i> Upload Image</a>
</div>
<div class="card shadow-sm">
    <div class="table-responsive"><table class="table table-hover mb-0 admin-datatable"><thead><tr><th>Image</th><th>Title</th><th>Category</th><th>Sort</th><th>Status</th><th>Actions</th></tr></thead>
    <tbody>@forelse($images as $image)<tr><td><img src="{{ asset('storage/'.$image->image) }}" height="40" class="rounded"></td><td>{{ $image->title ?? '—' }}</td><td>{{ $image->galleryCategory?->name ?? '—' }}</td><td>{{ $image->sort_order }}</td><td><span class="badge bg-{{ $image->is_active ? 'success' : 'secondary' }}">{{ $image->is_active ? 'Active' : 'Inactive' }}</span></td><td><a href="{{ route('admin.gallery-images.show', $image) }}" class="btn btn-sm btn-outline-secondary">View</a> <a href="{{ route('admin.gallery-images.edit', $image) }}" class="btn btn-sm btn-outline-primary">Edit</a> <form action="{{ route('admin.gallery-images.destroy', $image) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Delete</button></form></td></tr>@empty<tr><td colspan="6" class="text-center text-muted py-4">No images.</td></tr>@endforelse</tbody></table></div>
</div>
@endsection
