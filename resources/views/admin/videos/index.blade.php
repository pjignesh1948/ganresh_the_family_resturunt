@extends('layouts.admin')

@section('title', 'Videos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Videos</h1>
    <a href="{{ route('admin.videos.create') }}" class="btn btn-maroon"><i class="bi bi-plus-lg"></i> Add Video</a>
</div>
<div class="card shadow-sm">
    <div class="table-responsive"><table class="table table-hover mb-0 admin-datatable"><thead><tr><th>Title</th><th>Category</th><th>Sort</th><th>Status</th><th>Actions</th></tr></thead>
    <tbody>@forelse($videos as $video)<tr><td>{{ $video->title }}</td><td>{{ $video->videoCategory?->name ?? '—' }}</td><td>{{ $video->sort_order }}</td><td><span class="badge bg-{{ $video->is_active ? 'success' : 'secondary' }}">{{ $video->is_active ? 'Active' : 'Inactive' }}</span></td><td><a href="{{ route('admin.videos.show', $video) }}" class="btn btn-sm btn-outline-secondary">View</a> <a href="{{ route('admin.videos.edit', $video) }}" class="btn btn-sm btn-outline-primary">Edit</a> <form action="{{ route('admin.videos.destroy', $video) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Delete</button></form></td></tr>@empty<tr><td colspan="5" class="text-center text-muted py-4">No videos.</td></tr>@endforelse</tbody></table></div>
</div>
@endsection
