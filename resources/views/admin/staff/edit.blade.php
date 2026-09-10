@extends('layouts.admin')

@section('title', 'Edit Staff')

@section('content')
<div class="mb-4"><h1 class="h3 mb-0">Edit Staff Member</h1></div>
<div class="card shadow-sm"><div class="card-body">
<form action="{{ route('admin.staff.update', $staff) }}" method="POST">@csrf @method('PUT')
    <div class="row g-3">
        <div class="col-md-6"><label class="form-label">Name *</label><input type="text" name="name" class="form-control" value="{{ old('name', $staff->name) }}" required></div>
        <div class="col-md-6"><label class="form-label">Role</label><input type="text" name="role" class="form-control" value="{{ old('role', $staff->role) }}"></div>
        <div class="col-md-6"><label class="form-label">Phone</label><input type="text" name="phone" class="form-control" value="{{ old('phone', $staff->phone) }}"></div>
        <div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="{{ old('email', $staff->email) }}"></div>
        <div class="col-md-6"><label class="form-label">Joining Date</label><input type="date" name="joining_date" class="form-control" value="{{ old('joining_date', $staff->joining_date?->format('Y-m-d')) }}"></div>
        <div class="col-md-6"><label class="form-label">Monthly Salary</label><input type="number" name="monthly_salary" class="form-control" value="{{ old('monthly_salary', $staff->monthly_salary) }}" step="0.01" min="0"></div>
        <div class="col-12"><label class="form-label">Notes</label><textarea name="notes" class="form-control" rows="3">{{ old('notes', $staff->notes) }}</textarea></div>
        <div class="col-12 form-check"><input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active" {{ old('is_active', $staff->is_active) ? 'checked' : '' }}><label class="form-check-label" for="is_active">Active</label></div>
        <div class="col-12"><button type="submit" class="btn btn-maroon">Update</button> <a href="{{ route('admin.staff.index') }}" class="btn btn-outline-secondary">Cancel</a></div>
    </div>
</form></div></div>
@endsection
