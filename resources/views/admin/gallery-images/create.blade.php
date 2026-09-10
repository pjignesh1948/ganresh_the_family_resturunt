@extends('layouts.admin')

@section('title', 'Upload Gallery Image')

@section('content')
<div class="mb-4"><h1 class="h3 mb-0">Upload Gallery Image</h1></div>
<div class="card shadow-sm"><div class="card-body">
<form action="{{ route('admin.gallery-images.store') }}" method="POST" enctype="multipart/form-data">@csrf
    <div class="mb-3"><label class="form-label">Category</label><select name="gallery_category_id" class="form-select"><option value="">None</option>@foreach($categories as $cat)<option value="{{ $cat->id }}" {{ old('gallery_category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>@endforeach</select></div>
    <div class="mb-3"><label class="form-label">Title</label><input type="text" name="title" class="form-control" value="{{ old('title') }}"></div>
    <div class="mb-3"><label class="form-label">Image *</label><input type="file" name="image" class="form-control" accept="image/*" required></div>
    <div class="mb-3"><label class="form-label">Caption</label><textarea name="caption" class="form-control" rows="2">{{ old('caption') }}</textarea></div>
    <div class="mb-3"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" min="0"></div>
    <div class="mb-3 form-check"><input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active" checked><label class="form-check-label" for="is_active">Active</label></div>
    <button type="submit" class="btn btn-maroon">Upload</button> <a href="{{ route('admin.gallery-images.index') }}" class="btn btn-outline-secondary">Cancel</a>
</form></div></div>
@endsection
