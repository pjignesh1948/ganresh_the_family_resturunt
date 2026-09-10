@extends('layouts.admin')

@section('title', 'Add Vegetable')

@section('content')
<div class="mb-4"><h1 class="h3 mb-0">Add Vegetable</h1></div>
<div class="card shadow-sm"><div class="card-body">
<form action="{{ route('admin.vegetables.store') }}" method="POST" enctype="multipart/form-data">@csrf
    <div class="row g-3">
        <div class="col-md-6"><label class="form-label">Name (English) *</label><input type="text" name="name" class="form-control" value="{{ old('name') }}" required></div>
        <div class="col-md-3"><label class="form-label">Name (Hindi)</label><input type="text" name="name_hi" class="form-control" value="{{ old('name_hi') }}"></div>
        <div class="col-md-3"><label class="form-label">Name (Gujarati)</label><input type="text" name="name_gu" class="form-control" value="{{ old('name_gu') }}"></div>
        <div class="col-md-6"><label class="form-label">Type</label><input type="text" name="type" class="form-control" value="{{ old('type', 'vegetable') }}"></div>
        <div class="col-md-6"><label class="form-label">Retail Price / kg *</label><input type="number" name="retail_price_per_kg" class="form-control" value="{{ old('retail_price_per_kg') }}" step="0.01" min="0" required></div>
        <div class="col-md-6"><label class="form-label">Vendor Price / kg</label><input type="number" name="vendor_price_per_kg" class="form-control" value="{{ old('vendor_price_per_kg') }}" step="0.01" min="0"></div>
        <div class="col-md-6"><label class="form-label">Unit</label><input type="text" name="unit" class="form-control" value="{{ old('unit', 'kg') }}"></div>
        <div class="col-md-6"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" min="0"></div>
        <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea></div>
        <div class="col-12"><label class="form-label">Image</label><input type="file" name="image" class="form-control" accept="image/*"></div>
        <div class="col-12 form-check"><input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active" checked><label class="form-check-label" for="is_active">Active</label></div>
        <div class="col-12"><button type="submit" class="btn btn-accent">Create</button> <a href="{{ route('admin.vegetables.index') }}" class="btn btn-outline-secondary">Cancel</a></div>
    </div>
</form></div></div>
@endsection
