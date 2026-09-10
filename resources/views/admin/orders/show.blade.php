@extends('layouts.admin')

@section('title', 'Order ' . $order->order_no)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h1 class="h3 mb-0">Order {{ $order->order_no }}</h1>
    <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="d-flex gap-2 align-items-center">
        @csrf @method('PATCH')
        <select name="status" class="form-select form-select-sm">
            @foreach($statuses as $status)
                <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-sm btn-danger">Update Status</button>
    </form>
</div>
<div class="row g-4">
    <div class="col-md-4">
        <div class="card shadow-sm"><div class="card-header fw-semibold">Customer</div><div class="card-body">
            <p class="mb-1"><strong>{{ $order->customer_name }}</strong></p>
            <p class="mb-1"><a href="tel:{{ $order->phone }}">{{ $order->phone }}</a></p>
            @if($order->email)<p class="mb-1">{{ $order->email }}</p>@endif
            @if($order->address)<p class="mb-1">{{ $order->address }}</p>@endif
            @if($order->notes)<p class="mb-0 text-muted small"><em>{{ $order->notes }}</em></p>@endif
        </div></div>
        <div class="card shadow-sm mt-3"><div class="card-header fw-semibold">Activity Log</div><div class="card-body p-0">
            <ul class="list-group list-group-flush small">
                @forelse($order->activityLogs as $log)
                <li class="list-group-item">
                    <strong>{{ ucfirst(str_replace('_', ' ', $log->action)) }}</strong>
                    @if($log->status) — {{ $log->status }} @endif
                    <br><span class="text-muted">{{ $log->created_at->format('d M Y, h:i A') }}</span>
                    @if($log->note)<br>{{ $log->note }}@endif
                </li>
                @empty
                <li class="list-group-item text-muted">No logs yet.</li>
                @endforelse
            </ul>
        </div></div>
    </div>
    <div class="col-md-8">
        <div class="card shadow-sm"><div class="card-header fw-semibold">Order Items</div>
        <div class="table-responsive"><table class="table mb-0"><thead><tr><th>Item</th><th>Qty</th><th>Unit</th><th>Total</th></tr></thead>
        <tbody>@foreach($order->orderItems as $item)<tr><td>{{ $item->item_name }}</td><td>{{ $item->quantity }}</td><td>₹{{ number_format($item->unit_price, 2) }}</td><td>₹{{ number_format($item->line_total, 2) }}</td></tr>@endforeach</tbody>
        <tfoot><tr><th colspan="3" class="text-end">Grand Total</th><th>₹{{ number_format($order->total_amount, 2) }}</th></tr></tfoot></table></div></div>
    </div>
</div>
<a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary mt-3">Back to Orders</a>
@endsection
