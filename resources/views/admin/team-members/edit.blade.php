@extends('layouts.admin')

@section('title', 'Edit Team Member')

@section('content')
<div class="mb-4"><h1 class="h3 mb-0">Edit Team Member</h1></div>
<div class="card"><div class="card-body">
<form action="{{ route('admin.team-members.update', $member) }}" method="POST" enctype="multipart/form-data">@csrf @method('PUT')
    <div class="row g-3">
        <div class="col-md-6"><label class="form-label">Name *</label><input type="text" name="name" class="form-control" value="{{ old('name', $member->name) }}" required></div>
        <div class="col-md-6"><label class="form-label">Role</label><input type="text" name="role" class="form-control" value="{{ old('role', $member->role) }}"></div>
        <div class="col-md-6"><label class="form-label">Phone</label><input type="text" name="phone" class="form-control" value="{{ old('phone', $member->phone) }}"></div>
        <div class="col-md-6"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $member->sort_order) }}" min="0"></div>
        <div class="col-12"><label class="form-label">Bio</label><textarea name="bio" class="form-control" rows="4">{{ old('bio', $member->bio) }}</textarea></div>
        <div class="col-12">
            <label class="form-label">Photo</label>
            @if($member->photo)
                <div class="mb-2"><img src="{{ asset('storage/'.$member->photo) }}" height="80" class="rounded"></div>
            @endif
            <input type="file" name="photo" class="form-control" accept="image/*">
        </div>
        <div class="col-12 form-check"><input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active" {{ old('is_active', $member->is_active) ? 'checked' : '' }}><label class="form-check-label" for="is_active">Active</label></div>
        <div class="col-12"><button type="submit" class="btn btn-accent">Update</button> <a href="{{ route('admin.team-members.index') }}" class="btn btn-outline-secondary">Cancel</a></div>
    </div>
</form></div></div>
@endsection
