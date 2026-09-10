@extends('layouts.admin')

@section('title', $menuItem->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">{{ $menuItem->name }}</h1>
    <a href="{{ route('admin.menu-items.edit', $menuItem) }}" class="btn btn-maroon">Edit</a>
</div>
<div class="row g-4">
    <div class="col-md-4"><div class="card shadow-sm"><div class="card-body">
        @if($menuItem->image)<img src="{{ asset('storage/'.$menuItem->image) }}" class="img-fluid rounded mb-3">@endif
        <p><strong>Category:</strong> {{ $menuItem->menuCategory?->name }}</p>
        <p><strong>Price:</strong> ₹{{ number_format($menuItem->price, 2) }}</p>
        <p><strong>Vegetarian:</strong> {{ $menuItem->is_veg ? 'Yes' : 'No' }}</p>
        <p><strong>Available:</strong> {{ $menuItem->is_available ? 'Yes' : 'No' }}</p>
        <p><strong>Sort Order:</strong> {{ $menuItem->sort_order }}</p>
    </div></div></div>
    <div class="col-md-8"><div class="card shadow-sm"><div class="card-body">@if($menuItem->description)<p>{{ $menuItem->description }}</p>@else<p class="text-muted">No description.</p>@endif</div></div></div>
</div>
<a href="{{ route('admin.menu-items.index') }}" class="btn btn-outline-secondary mt-3">Back</a>
@endsection
