@extends('layouts.admin')

@section('title', 'Edit Menu Item')

@section('content')
<div class="mb-4"><h1 class="h3 mb-0">Edit Menu Item</h1></div>
<div class="card shadow-sm"><div class="card-body">
<form action="{{ route('admin.menu-items.update', $menuItem) }}" method="POST" enctype="multipart/form-data">@csrf @method('PUT')
    <div class="mb-3"><label class="form-label">Category *</label>
        <select name="menu_category_id" class="form-select" required>@foreach($categories as $cat)<option value="{{ $cat->id }}" {{ old('menu_category_id', $menuItem->menu_category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>@endforeach</select></div>
    <div class="mb-3"><label class="form-label">Name *</label><input type="text" name="name" class="form-control" value="{{ old('name', $menuItem->name) }}" required></div>
    <div class="mb-3"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3">{{ old('description', $menuItem->description) }}</textarea></div>
    <div class="mb-3"><label class="form-label">Price *</label><input type="number" name="price" class="form-control" value="{{ old('price', $menuItem->price) }}" step="0.01" min="0" required></div>
    <div class="mb-3"><label class="form-label">Image</label>@if($menuItem->image)<div class="mb-2"><img src="{{ asset('storage/'.$menuItem->image) }}" height="60" class="rounded"></div>@endif<input type="file" name="image" class="form-control" accept="image/*"></div>
    <div class="mb-3"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $menuItem->sort_order) }}" min="0"></div>
    <div class="mb-3 form-check"><input type="checkbox" name="is_veg" value="1" class="form-check-input" id="is_veg" {{ old('is_veg', $menuItem->is_veg) ? 'checked' : '' }}><label class="form-check-label" for="is_veg">Vegetarian</label></div>
    <div class="mb-3 form-check"><input type="checkbox" name="is_available" value="1" class="form-check-input" id="is_available" {{ old('is_available', $menuItem->is_available) ? 'checked' : '' }}><label class="form-check-label" for="is_available">Available</label></div>
    <button type="submit" class="btn btn-maroon">Update</button>
    <a href="{{ route('admin.menu-items.index') }}" class="btn btn-outline-secondary">Cancel</a>
</form></div></div>
@endsection
