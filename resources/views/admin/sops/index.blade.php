@extends('layouts.admin')

@section('title', 'SOPs')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Standard Operating Procedures</h1>
    <a href="{{ route('admin.sops.create') }}" class="btn btn-maroon"><i class="bi bi-plus-lg"></i> Add SOP</a>
</div>
<div class="card shadow-sm">
    <div class="table-responsive"><table class="table table-hover mb-0 admin-datatable"><thead><tr><th>Title</th><th>Category</th><th>Version</th><th>Status</th><th>Actions</th></tr></thead>
    <tbody>@forelse($sops as $sop)<tr><td>{{ $sop->title }}</td><td>{{ $sop->category ?? '—' }}</td><td>{{ $sop->version }}</td><td><span class="badge bg-{{ $sop->is_active ? 'success' : 'secondary' }}">{{ $sop->is_active ? 'Active' : 'Inactive' }}</span></td><td><a href="{{ route('admin.sops.show', $sop) }}" class="btn btn-sm btn-outline-secondary">View</a> <a href="{{ route('admin.sops.edit', $sop) }}" class="btn btn-sm btn-outline-primary">Edit</a> <form action="{{ route('admin.sops.destroy', $sop) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Delete</button></form></td></tr>@empty<tr><td colspan="5" class="text-center text-muted py-4">No SOPs found.</td></tr>@endforelse</tbody></table></div>
</div>
@endsection
