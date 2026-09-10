@extends('layouts.admin')

@section('title', 'Orders')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 mb-0">Orders</h1>
        <p class="text-muted small mb-0"><i class="bi bi-volume-up"></i> Live voice alerts active — keep this admin tab open to hear new orders</p>
    </div>
    <form method="GET" class="d-flex gap-2">
        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
            <option value="">All Statuses</option>
            @foreach($statuses as $status)
                <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
            @endforeach
        </select>
    </form>
</div>
<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0 admin-datatable">
            <thead><tr><th>Order #</th><th>Customer</th><th>Phone</th><th>Total</th><th>Status</th><th>Date</th><th></th></tr></thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->order_no }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>₹{{ number_format($order->total_amount, 2) }}</td>
                        <td><span class="badge bg-secondary">{{ ucfirst($order->status) }}</span></td>
                        <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                        <td><a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-primary">View</a></td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No orders found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
