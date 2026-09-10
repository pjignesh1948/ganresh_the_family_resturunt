@extends('layouts.admin')

@section('title', $staff->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">{{ $staff->name }}</h1>
    <a href="{{ route('admin.staff.edit', $staff) }}" class="btn btn-maroon">Edit</a>
</div>
<div class="row g-4">
    <div class="col-md-4"><div class="card shadow-sm"><div class="card-body">
        <p><strong>Role:</strong> {{ $staff->role ?? '—' }}</p>
        <p><strong>Phone:</strong> {{ $staff->phone ?? '—' }}</p>
        <p><strong>Email:</strong> {{ $staff->email ?? '—' }}</p>
        <p><strong>Joining:</strong> {{ $staff->joining_date?->format('M d, Y') ?? '—' }}</p>
        <p><strong>Monthly Salary:</strong> ₹{{ number_format($staff->monthly_salary, 2) }}</p>
        <p><strong>Status:</strong> {{ $staff->is_active ? 'Active' : 'Inactive' }}</p>
        @if($staff->notes)<p class="text-muted small">{{ $staff->notes }}</p>@endif
    </div></div></div>
    <div class="col-md-8"><div class="card shadow-sm"><div class="card-header fw-semibold">Recent Salary Transactions</div>
    <div class="table-responsive"><table class="table mb-0"><thead><tr><th>Date</th><th>Type</th><th>Amount</th><th>Period</th><th>Note</th></tr></thead>
    <tbody>@forelse($staff->salaryTransactions as $tx)<tr><td>{{ $tx->transaction_date->format('M d, Y') }}</td><td>{{ ucfirst($tx->type) }}</td><td>₹{{ number_format($tx->amount, 2) }}</td><td>@if($tx->month){{ date('F', mktime(0,0,0,$tx->month,1)) }} {{ $tx->year }}@else—@endif</td><td>{{ $tx->note ?? '—' }}</td></tr>@empty<tr><td colspan="5" class="text-muted">No transactions.</td></tr>@endforelse</tbody></table></div></div></div>
</div>
<a href="{{ route('admin.staff.index') }}" class="btn btn-outline-secondary mt-3">Back</a>
@endsection
