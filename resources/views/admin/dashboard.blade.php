@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1">Dashboard</h1>
        <p class="text-muted mb-0 small">Welcome back — manage your restaurant from here.</p>
    </div>
    <a href="{{ route('front.home') }}" target="_blank" class="btn btn-outline-accent btn-sm">
        <i class="bi bi-box-arrow-up-right me-1"></i> View Site
    </a>
</div>

{{-- Stats row --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card card-stat">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small">Total Orders</div>
                        <div class="fs-3 fw-bold">{{ $stats['orders_total'] }}</div>
                    </div>
                    <div class="module-icon" style="background: rgba(16,185,129,.15); color: #10b981;">
                        <i class="bi bi-bag-check-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card card-stat" style="border-left-color: #f59e0b;">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small">Pending Orders</div>
                        <div class="fs-3 fw-bold" style="color: #fcd34d;">{{ $stats['orders_pending'] }}</div>
                    </div>
                    <div class="module-icon" style="background: rgba(245,158,11,.15); color: #f59e0b;">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card card-stat" style="border-left-color: #818cf8;">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small">Veg Sales Today</div>
                        <div class="fs-3 fw-bold" style="color: #818cf8;">₹{{ number_format($stats['veg_sales_today'], 0) }}</div>
                    </div>
                    <div class="module-icon" style="background: rgba(129,140,248,.15); color: #818cf8;">
                        <i class="bi bi-cart-check"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card card-stat" style="border-left-color: #f97316;">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small">Unread Messages</div>
                        <div class="fs-3 fw-bold" style="color: #fb923c;">{{ $stats['unread_messages'] }}</div>
                    </div>
                    <div class="module-icon" style="background: rgba(249,115,22,.15); color: #f97316;">
                        <i class="bi bi-envelope-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Module cards --}}
<h5 class="mb-3"><i class="bi bi-grid-3x3-gap me-2" style="color: #818cf8;"></i>Modules</h5>
<div class="row g-3 mb-4">
    @foreach($modules as $mod)
        <div class="col-sm-6 col-md-4 col-xl-3">
            <a href="{{ route($mod['route']) }}" class="module-card">
                <div class="module-icon" style="background: {{ $mod['color'] }}22; color: {{ $mod['color'] }};">
                    <i class="bi {{ $mod['icon'] }}"></i>
                </div>
                <div class="module-count">{{ $mod['count'] }}</div>
                <div class="module-label">{{ $mod['label'] }}</div>
            </a>
        </div>
    @endforeach
</div>

{{-- Recent orders --}}
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-clock-history me-2"></i>Recent Orders</span>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-accent">View All</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $order)
                    <tr>
                        <td><span class="fw-semibold">{{ $order->order_no }}</span></td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>₹{{ number_format($order->total_amount, 2) }}</td>
                        <td>
                            @php
                                $statusClass = match($order->status) {
                                    'pending' => 'bg-warning',
                                    'confirmed', 'preparing' => 'bg-secondary',
                                    'delivered', 'completed' => 'bg-success',
                                    'cancelled' => 'bg-danger',
                                    default => 'bg-secondary',
                                };
                            @endphp
                            <span class="badge {{ $statusClass }}">{{ ucfirst($order->status) }}</span>
                        </td>
                        <td class="text-muted">{{ $order->created_at->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-accent">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No orders yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
