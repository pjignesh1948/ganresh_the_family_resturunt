@extends('layouts.admin')

@section('title', 'Edit Menu Category')

@section('content')
<div class="mb-4"><h1 class="h3 mb-0">Edit Menu Category</h1></div>
<div class="card shadow-sm"><div class="card-body">
<form action="{{ route('admin.menu-categories.update', $menuCategory) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="mb-3"><label class="form-label">Name *</label><input type="text" name="name" class="form-control" value="{{ old('name', $menuCategory->name) }}" required></div>
    <div class="mb-3"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3">{{ old('description', $menuCategory->description) }}</textarea></div>
    <div class="mb-3"><label class="form-label">Image</label>
        @if($menuCategory->image)<div class="mb-2"><img src="{{ asset('storage/'.$menuCategory->image) }}" height="60" class="rounded"></div>@endif
        <input type="file" name="image" class="form-control" accept="image/*"></div>
    <div class="mb-3"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $menuCategory->sort_order) }}" min="0"></div>
    <div class="mb-3 form-check"><input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active" {{ old('is_active', $menuCategory->is_active) ? 'checked' : '' }}><label class="form-check-label" for="is_active">Active</label></div>
    <button type="submit" class="btn btn-maroon">Update</button>
    <a href="{{ route('admin.menu-categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
</form>
</div></div>
@endsection
