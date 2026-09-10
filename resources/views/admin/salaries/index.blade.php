@extends('layouts.admin')

@section('title', 'Salary Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div><h1 class="h3 mb-0">Salary Management</h1><p class="text-muted small mb-0">Track salary, advances & remaining balance per staff</p></div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4"><div class="card card-stat"><div class="card-body"><div class="text-muted small">Total Monthly Salary</div><div class="fs-4 fw-bold">₹{{ number_format($totals['monthly'], 0) }}</div></div></div></div>
    <div class="col-md-4"><div class="card card-stat" style="border-left-color:#10b981"><div class="card-body"><div class="text-muted small">Total Paid ({{ date('F', mktime(0,0,0,$month,1)) }} {{ $year }})</div><div class="fs-4 fw-bold text-success">₹{{ number_format($totals['paid'], 0) }}</div></div></div></div>
    <div class="col-md-4"><div class="card card-stat" style="border-left-color:#f59e0b"><div class="card-body"><div class="text-muted small">Remaining to Pay</div><div class="fs-4 fw-bold" style="color:#fcd34d">₹{{ number_format($totals['remaining'], 0) }}</div></div></div></div>
</div>

<div class="card shadow-sm mb-4"><div class="card-header fw-semibold"><i class="bi bi-person-lines-fill"></i> Staff Salary Summary — {{ date('F', mktime(0,0,0,$month,1)) }} {{ $year }}</div>
<div class="table-responsive"><table class="table table-hover mb-0 admin-datatable"><thead><tr><th>Staff</th><th>Monthly Salary</th><th>Salary Paid</th><th>Advance</th><th>Total Paid</th><th>Remaining</th><th>Status</th></tr></thead>
<tbody>@foreach($summaries as $s)<tr>
    <td><strong>{{ $s['staff']->name }}</strong><div class="small text-muted">{{ $s['staff']->role ?? '' }}</div></td>
    <td>₹{{ number_format($s['monthly_salary'], 0) }}</td>
    <td>₹{{ number_format($s['salary_paid'], 0) }}</td>
    <td>₹{{ number_format($s['advance_paid'], 0) }}</td>
    <td class="text-success fw-semibold">₹{{ number_format($s['total_paid'], 0) }}</td>
    <td class="fw-bold {{ $s['remaining'] > 0 ? 'text-warning' : 'text-success' }}">₹{{ number_format($s['remaining'], 0) }}</td>
    <td>@if($s['remaining'] <= 0)<span class="badge bg-success">Paid</span>@elseif($s['total_paid'] > 0)<span class="badge bg-warning text-dark">Partial</span>@else<span class="badge bg-secondary">Pending</span>@endif</td>
</tr>@endforeach</tbody></table></div></div>

<div class="card shadow-sm mb-4"><div class="card-header fw-semibold">Record Transaction</div><div class="card-body">
<form action="{{ route('admin.salaries.store') }}" method="POST">@csrf
    <div class="row g-3">
        <div class="col-md-3"><label class="form-label">Staff *</label><select name="staff_id" class="form-select" required><option value="">Select...</option>@foreach($staffMembers as $s)<option value="{{ $s->id }}">{{ $s->name }} (₹{{ number_format($s->monthly_salary,0) }}/mo)</option>@endforeach</select></div>
        <div class="col-md-2"><label class="form-label">Type *</label><select name="type" class="form-select" required>@foreach($types as $type)<option value="{{ $type }}">{{ ucfirst($type) }}</option>@endforeach</select></div>
        <div class="col-md-2"><label class="form-label">Amount *</label><input type="number" name="amount" class="form-control" step="0.01" min="0" required></div>
        <div class="col-md-2"><label class="form-label">Date *</label><input type="date" name="transaction_date" class="form-control" value="{{ date('Y-m-d') }}" required></div>
        <div class="col-md-1"><label class="form-label">Month</label><input type="number" name="month" class="form-control" value="{{ $month }}" min="1" max="12"></div>
        <div class="col-md-1"><label class="form-label">Year</label><input type="number" name="year" class="form-control" value="{{ $year }}" min="2000"></div>
        <div class="col-md-12"><label class="form-label">Note</label><input type="text" name="note" class="form-control" placeholder="Optional note"></div>
        <div class="col-12"><button type="submit" class="btn btn-accent"><i class="bi bi-plus-circle"></i> Record Transaction</button></div>
    </div>
</form></div></div>

<div class="card shadow-sm mb-3"><div class="card-body">
<form method="GET" class="row g-2 align-items-end">
    <div class="col-md-2"><label class="form-label">Month</label><select name="month" class="form-select">@for($m=1;$m<=12;$m++)<option value="{{ $m }}" {{ $month==$m?'selected':'' }}>{{ date('F', mktime(0,0,0,$m,1)) }}</option>@endfor</select></div>
    <div class="col-md-2"><label class="form-label">Year</label><input type="number" name="year" class="form-control" value="{{ $year }}"></div>
    <div class="col-md-3"><label class="form-label">Staff</label><select name="staff_id" class="form-select"><option value="">All Staff</option>@foreach($staffMembers as $s)<option value="{{ $s->id }}" {{ request('staff_id')==$s->id?'selected':'' }}>{{ $s->name }}</option>@endforeach</select></div>
    <div class="col-md-2"><label class="form-label">Type</label><select name="type" class="form-select"><option value="">All</option>@foreach($types as $type)<option value="{{ $type }}" {{ request('type')===$type?'selected':'' }}>{{ ucfirst($type) }}</option>@endforeach</select></div>
    <div class="col-md-3"><input type="hidden" name="filter_month" value="1"><button type="submit" class="btn btn-accent w-100"><i class="bi bi-funnel"></i> Apply Filters</button></div>
</form></div></div>

<div class="card shadow-sm"><div class="card-header fw-semibold">Transaction History</div>
<div class="table-responsive"><table class="table table-hover mb-0 admin-datatable"><thead><tr><th>Date</th><th>Staff</th><th>Type</th><th>Amount</th><th>Period</th><th>Note</th></tr></thead>
<tbody>@forelse($transactions as $tx)<tr>
    <td>{{ $tx->transaction_date->format('d M Y') }}</td>
    <td>{{ $tx->staff?->name }}</td>
    <td><span class="badge bg-{{ $tx->type==='salary'?'success':'warning text-dark' }}">{{ ucfirst($tx->type) }}</span></td>
    <td class="fw-semibold">₹{{ number_format($tx->amount, 2) }}</td>
    <td>@if($tx->month){{ date('M', mktime(0,0,0,$tx->month,1)) }} {{ $tx->year }}@else—@endif</td>
    <td>{{ $tx->note ?? '—' }}</td>
</tr>@empty<tr><td colspan="6" class="text-center text-muted py-4">No transactions for selected filters.</td></tr>@endforelse</tbody></table></div></div>
@endsection
