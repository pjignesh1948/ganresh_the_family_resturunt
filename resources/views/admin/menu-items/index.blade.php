@extends('layouts.admin')

@section('title', 'Menu Items')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Menu Items</h1>
    <a href="{{ route('admin.menu-items.create') }}" class="btn btn-accent"><i class="bi bi-plus-lg"></i> Add Item</a>
</div>
<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0 admin-datatable">
            <thead><tr><th>Image</th><th>Name</th><th>Category</th><th>Price</th><th>Veg</th><th>Available</th><th>Actions</th></tr></thead>
            <tbody>
                @foreach($menuItems as $item)
                    <tr>
                        <td>@if($item->image)<img src="@media($item->image)" height="48" width="48" class="rounded object-fit-cover" alt="" onerror="this.src='{{ asset('images/logo-icon.png') }}'">@else—@endif</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->menuCategory?->name ?? '—' }}</td>
                        <td class="fw-semibold">₹{{ number_format($item->price, 0) }}</td>
                        <td>{{ $item->is_veg ? 'Yes' : 'No' }}</td>
                        <td><span class="badge bg-{{ $item->is_available ? 'success' : 'secondary' }}">{{ $item->is_available ? 'Yes' : 'No' }}</span></td>
                        <td>
                            <a href="{{ route('admin.menu-items.edit', $item) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('admin.menu-items.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Delete</button></form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
