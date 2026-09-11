@extends('layouts.admin')

@section('title', 'Edit Vegetable')

@section('content')
<div class="mb-4"><h1 class="h3 mb-0">Edit Vegetable</h1></div>
<div class="card shadow-sm"><div class="card-body">
<form action="{{ route('admin.vegetables.update', $vegetable) }}" method="POST" enctype="multipart/form-data">@csrf @method('PUT')
    <div class="row g-3">
        <div class="col-md-6"><label class="form-label">Name (English) *</label><input type="text" name="name" class="form-control" value="{{ old('name', $vegetable->name) }}" required></div>
        <div class="col-md-3"><label class="form-label">Name (Hindi)</label><input type="text" name="name_hi" class="form-control" value="{{ old('name_hi', $vegetable->name_hi) }}"></div>
        <div class="col-md-3"><label class="form-label">Name (Gujarati)</label><input type="text" name="name_gu" class="form-control" value="{{ old('name_gu', $vegetable->name_gu) }}"></div>
        <div class="col-md-6"><label class="form-label">Type</label><input type="text" name="type" class="form-control" value="{{ old('type', $vegetable->type) }}"></div>
        <div class="col-md-6"><label class="form-label">Retail Price / kg *</label><input type="number" name="retail_price_per_kg" class="form-control" value="{{ old('retail_price_per_kg', $vegetable->retail_price_per_kg) }}" step="0.01" min="0" required></div>
        <div class="col-md-6"><label class="form-label">Vendor Price / kg</label><input type="number" name="vendor_price_per_kg" class="form-control" value="{{ old('vendor_price_per_kg', $vegetable->vendor_price_per_kg) }}" step="0.01" min="0"></div>
        <div class="col-md-6"><label class="form-label">Unit</label><input type="text" name="unit" class="form-control" value="{{ old('unit', $vegetable->unit) }}"></div>
        <div class="col-md-6"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $vegetable->sort_order) }}" min="0"></div>
        <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3">{{ old('description', $vegetable->description) }}</textarea></div>
        <div class="col-12"><label class="form-label">Image</label>@if($vegetable->image)<div class="mb-2"><img src="@media($vegetable->image)" height="80" class="rounded object-fit-cover" alt="{{ $vegetable->name }}" onerror="this.src='{{ asset('images/logo-icon.png') }}'"></div>@endif<input type="file" name="image" class="form-control" accept="image/*"></div>
        <div class="col-12 form-check"><input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active" {{ old('is_active', $vegetable->is_active) ? 'checked' : '' }}><label class="form-check-label" for="is_active">Active</label></div>
        <div class="col-12"><button type="submit" class="btn btn-accent">Update</button> <a href="{{ route('admin.vegetables.index') }}" class="btn btn-outline-secondary">Cancel</a></div>
    </div>
</form></div></div>
@endsection
