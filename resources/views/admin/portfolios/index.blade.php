@extends('layouts.admin')

@section('title', 'Portfolio')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Portfolio</h1>
    <a href="{{ route('admin.portfolios.create') }}" class="btn btn-maroon"><i class="bi bi-plus-lg"></i> Add Item</a>
</div>
<div class="card shadow-sm">
    <div class="table-responsive"><table class="table table-hover mb-0 admin-datatable"><thead><tr><th>Image</th><th>Title</th><th>Event Date</th><th>Sort</th><th>Status</th><th>Actions</th></tr></thead>
    <tbody>@forelse($portfolios as $portfolio)<tr><td>@if($portfolio->image)<img src="{{ asset('storage/'.$portfolio->image) }}" height="40" class="rounded">@else—@endif</td><td>{{ $portfolio->title }}</td><td>{{ $portfolio->event_date?->format('M d, Y') ?? '—' }}</td><td>{{ $portfolio->sort_order }}</td><td><span class="badge bg-{{ $portfolio->is_active ? 'success' : 'secondary' }}">{{ $portfolio->is_active ? 'Active' : 'Inactive' }}</span></td><td><a href="{{ route('admin.portfolios.show', $portfolio) }}" class="btn btn-sm btn-outline-secondary">View</a> <a href="{{ route('admin.portfolios.edit', $portfolio) }}" class="btn btn-sm btn-outline-primary">Edit</a> <form action="{{ route('admin.portfolios.destroy', $portfolio) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Delete</button></form></td></tr>@empty<tr><td colspan="6" class="text-center text-muted py-4">No portfolio items.</td></tr>@endforelse</tbody></table></div>
</div>
@endsection
