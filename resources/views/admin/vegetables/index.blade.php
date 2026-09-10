@extends('layouts.admin')

@section('title', 'Vegetables')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h1 class="h3 mb-0">Vegetables</h1>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.vegetables.flyer') }}" class="btn btn-accent"><i class="bi bi-magic"></i> Generate Daily Flyer</a>
        <a href="{{ route('admin.vegetables.create') }}" class="btn btn-outline-accent"><i class="bi bi-plus-lg"></i> Add Vegetable</a>
    </div>
</div>
<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0 admin-datatable">
            <thead><tr><th>Image</th><th>Name</th><th>Type</th><th>Hindi</th><th>Gujarati</th><th>Retail/kg</th><th>Vendor/kg</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
                @foreach($vegetables as $vegetable)
                    <tr>
                        <td>@if($vegetable->image)<img src="@media($vegetable->image)" height="44" width="44" class="rounded object-fit-cover" alt="" onerror="this.src='{{ asset('images/logo-icon.png') }}'">@else—@endif</td>
                        <td>{{ $vegetable->name }}</td>
                        <td><span class="badge bg-{{ $vegetable->type === 'fruit' ? 'warning text-dark' : 'success' }}">{{ ucfirst($vegetable->type ?? 'vegetable') }}</span></td>
                        <td>{{ $vegetable->name_hi ?? '—' }}</td>
                        <td>{{ $vegetable->name_gu ?? '—' }}</td>
                        <td>₹{{ number_format($vegetable->retail_price_per_kg, 2) }}</td>
                        <td>{{ $vegetable->vendor_price_per_kg ? '₹'.number_format($vegetable->vendor_price_per_kg, 2) : '—' }}</td>
                        <td><span class="badge bg-{{ $vegetable->is_active ? 'success' : 'secondary' }}">{{ $vegetable->is_active ? 'Active' : 'Inactive' }}</span></td>
                        <td>
                            <a href="{{ route('admin.vegetables.edit', $vegetable) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('admin.vegetables.destroy', $vegetable) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Delete</button></form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
