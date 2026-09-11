@extends('layouts.admin')

@section('title', 'Add Team Member')

@section('content')
<div class="mb-4"><h1 class="h3 mb-0">Add Team Member</h1></div>
<div class="card"><div class="card-body">
<form action="{{ route('admin.team-members.store') }}" method="POST" enctype="multipart/form-data">@csrf
    <div class="row g-3">
        <div class="col-md-6"><label class="form-label">Name *</label><input type="text" name="name" class="form-control" value="{{ old('name') }}" required></div>
        <div class="col-md-6"><label class="form-label">Role</label><input type="text" name="role" class="form-control" value="{{ old('role') }}" placeholder="e.g. Head Chef"></div>
        <div class="col-md-6"><label class="form-label">Phone</label><input type="text" name="phone" class="form-control" value="{{ old('phone') }}"></div>
        <div class="col-md-6"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" min="0"></div>
        <div class="col-12"><label class="form-label">Bio</label><textarea name="bio" class="form-control" rows="4">{{ old('bio') }}</textarea></div>
        <div class="col-md-6"><label class="form-label">Photo</label><input type="file" name="photo" class="form-control" accept="image/*"></div>
        <div class="col-md-6"><label class="form-label">Aadhar Card Image</label><input type="file" name="aadhar_card" class="form-control" accept="image/*"></div>
        <div class="col-12 form-check"><input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active" checked><label class="form-check-label" for="is_active">Active</label></div>
        <div class="col-12"><button type="submit" class="btn btn-accent">Create</button> <a href="{{ route('admin.team-members.index') }}" class="btn btn-outline-secondary">Cancel</a></div>
    </div>
</form></div></div>
@endsection
