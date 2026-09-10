@extends('layouts.admin')

@section('title', 'Edit Home Slider')

@section('content')
<div class="mb-4"><h1 class="h3 mb-0">Edit Home Slider</h1></div>
<div class="card"><div class="card-body">
<form action="{{ route('admin.home-sliders.update', $slider) }}" method="POST" enctype="multipart/form-data">@csrf @method('PUT')
    <div class="row g-3">
        <div class="col-md-6"><label class="form-label">Title</label><input type="text" name="title" class="form-control" value="{{ old('title', $slider->title) }}"></div>
        <div class="col-md-6"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $slider->sort_order) }}" min="0"></div>
        <div class="col-12"><label class="form-label">Subtitle</label><textarea name="subtitle" class="form-control" rows="2">{{ old('subtitle', $slider->subtitle) }}</textarea></div>
        <div class="col-12"><label class="form-label">Link URL</label><input type="url" name="link" class="form-control" value="{{ old('link', $slider->link) }}" placeholder="https://"></div>
        <div class="col-12">
            <label class="form-label">Image</label>
            @if($slider->image)
                <div class="mb-2"><img src="{{ asset('storage/'.$slider->image) }}" height="100" class="rounded"></div>
            @endif
            <input type="file" name="image" class="form-control" accept="image/*">
            <div class="form-text text-muted">Leave empty to keep current image.</div>
        </div>
        <div class="col-12 form-check"><input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active" {{ old('is_active', $slider->is_active) ? 'checked' : '' }}><label class="form-check-label" for="is_active">Active</label></div>
        <div class="col-12"><button type="submit" class="btn btn-accent">Update</button> <a href="{{ route('admin.home-sliders.index') }}" class="btn btn-outline-secondary">Cancel</a></div>
    </div>
</form></div></div>
@endsection
