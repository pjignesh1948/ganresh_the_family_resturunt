@extends('layouts.admin')

@section('title', $menuCategory->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">{{ $menuCategory->name }}</h1>
    <a href="{{ route('admin.menu-categories.edit', $menuCategory) }}" class="btn btn-maroon">Edit</a>
</div>
<div class="row g-4">
    <div class="col-md-4">
        <div class="card shadow-sm"><div class="card-body">
            @if($menuCategory->image)<img src="{{ asset('storage/'.$menuCategory->image) }}" class="img-fluid rounded mb-3">@endif
            <p><strong>Status:</strong> {{ $menuCategory->is_active ? 'Active' : 'Inactive' }}</p>
            <p><strong>Sort Order:</strong> {{ $menuCategory->sort_order }}</p>
            @if($menuCategory->description)<p>{{ $menuCategory->description }}</p>@endif
        </div></div>
    </div>
    <div class="col-md-8">
        <div class="card shadow-sm"><div class="card-header fw-semibold">Menu Items ({{ $menuCategory->menuItems->count() }})</div>
        <div class="table-responsive"><table class="table mb-0"><thead><tr><th>Name</th><th>Price</th><th>Available</th></tr></thead>
        <tbody>@forelse($menuCategory->menuItems as $item)<tr><td>{{ $item->name }}</td><td>₹{{ number_format($item->price, 2) }}</td><td>{{ $item->is_available ? 'Yes' : 'No' }}</td></tr>@empty<tr><td colspan="3" class="text-muted">No items.</td></tr>@endforelse</tbody></table></div></div>
    </div>
</div>
<a href="{{ route('admin.menu-categories.index') }}" class="btn btn-outline-secondary mt-3">Back</a>
@endsection
