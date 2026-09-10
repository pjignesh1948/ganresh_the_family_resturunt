@extends('layouts.admin')

@section('title', 'Edit Gallery Category')

@section('content')
<div class="mb-4"><h1 class="h3 mb-0">Edit Gallery Category</h1></div>
<div class="card shadow-sm"><div class="card-body">
<form action="{{ route('admin.gallery-categories.update', $galleryCategory) }}" method="POST">@csrf @method('PUT')
    <div class="mb-3"><label class="form-label">Name *</label><input type="text" name="name" class="form-control" value="{{ old('name', $galleryCategory->name) }}" required></div>
    <div class="mb-3"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $galleryCategory->sort_order) }}" min="0"></div>
    <div class="mb-3 form-check"><input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active" {{ old('is_active', $galleryCategory->is_active) ? 'checked' : '' }}><label class="form-check-label" for="is_active">Active</label></div>
    <button type="submit" class="btn btn-maroon">Update</button> <a href="{{ route('admin.gallery-categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
</form></div></div>
@endsection
