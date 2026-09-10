@extends('layouts.admin')

@section('title', $vegetable->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">{{ $vegetable->name }}</h1>
    <a href="{{ route('admin.vegetables.edit', $vegetable) }}" class="btn btn-maroon">Edit</a>
</div>
<div class="row g-4">
    <div class="col-md-4"><div class="card shadow-sm"><div class="card-body">
        @if($vegetable->image)<img src="{{ asset('storage/'.$vegetable->image) }}" class="img-fluid rounded mb-3">@endif
        <p><strong>Retail:</strong> ₹{{ number_format($vegetable->retail_price_per_kg, 2) }}/kg</p>
        <p><strong>Vendor:</strong> {{ $vegetable->vendor_price_per_kg ? '₹'.number_format($vegetable->vendor_price_per_kg, 2).'/kg' : 'N/A' }}</p>
        <p><strong>Type:</strong> {{ $vegetable->type }}</p>
        <p><strong>Status:</strong> {{ $vegetable->is_active ? 'Active' : 'Inactive' }}</p>
    </div></div></div>
    <div class="col-md-8"><div class="card shadow-sm"><div class="card-header fw-semibold">Price History</div>
    <div class="table-responsive"><table class="table mb-0"><thead><tr><th>Date</th><th>Retail/kg</th><th>Vendor/kg</th><th>Note</th></tr></thead>
    <tbody>@forelse($vegetable->priceLogs as $log)<tr><td>{{ $log->logged_date->format('M d, Y') }}</td><td>₹{{ number_format($log->retail_price_per_kg, 2) }}</td><td>{{ $log->vendor_price_per_kg ? '₹'.number_format($log->vendor_price_per_kg, 2) : '—' }}</td><td>{{ $log->note ?? '—' }}</td></tr>@empty<tr><td colspan="4" class="text-muted">No price logs.</td></tr>@endforelse</tbody></table></div></div></div>
</div>
<a href="{{ route('admin.vegetables.index') }}" class="btn btn-outline-secondary mt-3">Back</a>
@endsection
