@extends('layouts.admin')

@section('title', 'Add Home Slider')

@section('content')
<div class="mb-4"><h1 class="h3 mb-0">Add Home Slider</h1></div>
<div class="card"><div class="card-body">
<form action="{{ route('admin.home-sliders.store') }}" method="POST" enctype="multipart/form-data">@csrf
    <div class="row g-3">
        <div class="col-md-6"><label class="form-label">Title</label><input type="text" name="title" class="form-control" value="{{ old('title') }}"></div>
        <div class="col-md-6"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" min="0"></div>
        <div class="col-12"><label class="form-label">Subtitle</label><textarea name="subtitle" class="form-control" rows="2">{{ old('subtitle') }}</textarea></div>
        <div class="col-12"><label class="form-label">Link URL</label><input type="url" name="link" class="form-control" value="{{ old('link') }}" placeholder="https://"></div>
        <div class="col-12"><label class="form-label">Image *</label><input type="file" name="image" class="form-control" accept="image/*" required></div>
        <div class="col-12 form-check"><input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active" checked><label class="form-check-label" for="is_active">Active</label></div>
        <div class="col-12"><button type="submit" class="btn btn-accent">Create</button> <a href="{{ route('admin.home-sliders.index') }}" class="btn btn-outline-secondary">Cancel</a></div>
    </div>
</form></div></div>
@endsection
