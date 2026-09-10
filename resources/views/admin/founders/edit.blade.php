@extends('layouts.admin')

@section('title', 'Edit Founder')

@section('content')
<div class="mb-4"><h1 class="h3 mb-0">Edit Founder</h1></div>
<div class="card shadow-sm"><div class="card-body">
<form action="{{ route('admin.founders.update', $founder) }}" method="POST" enctype="multipart/form-data">@csrf @method('PUT')
    <div class="row g-3">
        <div class="col-md-6"><label class="form-label">Name *</label><input type="text" name="name" class="form-control" value="{{ old('name', $founder->name) }}" required></div>
        <div class="col-md-6"><label class="form-label">Title</label><input type="text" name="title" class="form-control" value="{{ old('title', $founder->title) }}"></div>
        <div class="col-12"><label class="form-label">Bio</label><textarea name="bio" class="form-control" rows="4">{{ old('bio', $founder->bio) }}</textarea></div>
        <div class="col-md-6"><label class="form-label">Photo</label>@if($founder->photo)<div class="mb-2"><img src="@media($founder->photo)" height="80" class="rounded"></div>@endif<input type="file" name="photo" class="form-control" accept="image/*"></div>
        <div class="col-md-3"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $founder->sort_order) }}" min="0"></div>
        <div class="col-md-3 form-check pt-4"><input type="checkbox" name="is_active" value="1" class="form-check-input" id="active" {{ old('is_active', $founder->is_active) ? 'checked' : '' }}><label class="form-check-label" for="active">Active</label></div>
        <div class="col-12"><button type="submit" class="btn btn-accent">Update</button> <a href="{{ route('admin.founders.index') }}" class="btn btn-outline-secondary">Cancel</a></div>
    </div>
</form></div></div>
@endsection
