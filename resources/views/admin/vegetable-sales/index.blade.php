@extends('layouts.admin')

@section('title', 'Vegetable Sales')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h1 class="h3 mb-0"><i class="bi bi-cart-check me-2" style="color: #818cf8;"></i>Vegetable Sales</h1>
    <div class="d-flex align-items-center gap-3">
        <div class="card px-3 py-2 mb-0">
            <span class="text-muted small">Daily Total</span>
            <span class="fw-bold fs-5" style="color: #f59e0b;">₹{{ number_format($dayTotal, 2) }}</span>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.vegetable-sales.index') }}" class="row g-3 align-items-end">
            <div class="col-auto">
                <label class="form-label">Filter by Date</label>
                <input type="date" name="date" class="form-control" value="{{ request('date', today()->format('Y-m-d')) }}">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-accent"><i class="bi bi-funnel me-1"></i>Filter</button>
                @if(request('date'))
                    <a href="{{ route('admin.vegetable-sales.index') }}" class="btn btn-outline-secondary">Clear</a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0 admin-datatable">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Vegetable</th>
                    <th>Weight (g)</th>
                    <th>Price Type</th>
                    <th>Unit Price/kg</th>
                    <th>Total</th>
                    <th>Note</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sales as $sale)
                    <tr>
                        <td>{{ $sale->sold_date->format('M d, Y') }}</td>
                        <td class="fw-semibold">{{ $sale->vegetable->name ?? '—' }}</td>
                        <td>{{ number_format($sale->grams, 0) }} g</td>
                        <td><span class="badge bg-secondary">{{ ucfirst($sale->price_type) }}</span></td>
                        <td>₹{{ number_format($sale->unit_price_per_kg, 2) }}</td>
                        <td class="fw-semibold" style="color: #f59e0b;">₹{{ number_format($sale->total_price, 2) }}</td>
                        <td class="text-muted small">{{ $sale->customer_note ?? '—' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No sales records found for this date.</td></tr>
                @endforelse
            </tbody>
            @if($sales->count())
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-end fw-semibold">Page Total</td>
                        <td class="fw-bold" style="color: #f59e0b;">₹{{ number_format($sales->sum('total_price'), 2) }}</td>
                        <td></td>
                    </tr>
                </tfoot>
            @endif
        </table>
    </div>
</div>
@endsection
