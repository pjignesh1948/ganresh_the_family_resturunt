@extends('layouts.admin')

@section('title', 'Edit Promotion')

@section('content')
<div class="mb-4"><h1 class="h3 mb-0">Edit Promotion</h1></div>
<div class="card"><div class="card-body">
<form action="{{ route('admin.promotions.update', $promotion) }}" method="POST" enctype="multipart/form-data">@csrf @method('PUT')
    <div class="row g-3">
        <div class="col-12"><label class="form-label">Title</label><input type="text" name="title" class="form-control" value="{{ old('title', $promotion->title) }}"></div>
        <div class="col-12"><label class="form-label">Link URL</label><input type="url" name="link" class="form-control" value="{{ old('link', $promotion->link) }}" placeholder="https://"></div>
        <div class="col-12">
            <label class="form-label">Image</label>
            @if($promotion->image)
                <div class="mb-2"><img src="{{ asset('storage/'.$promotion->image) }}" height="100" class="rounded"></div>
            @endif
            <input type="file" name="image" class="form-control" accept="image/*">
            <div class="form-text text-muted">Leave empty to keep current image.</div>
        </div>
        <div class="col-md-6 form-check"><input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active" {{ old('is_active', $promotion->is_active) ? 'checked' : '' }}><label class="form-check-label" for="is_active">Active</label></div>
        <div class="col-md-6 form-check"><input type="checkbox" name="show_once" value="1" class="form-check-input" id="show_once" {{ old('show_once', $promotion->show_once) ? 'checked' : '' }}><label class="form-check-label" for="show_once">Show once per visitor</label></div>
        <div class="col-12"><button type="submit" class="btn btn-accent">Update</button> <a href="{{ route('admin.promotions.index') }}" class="btn btn-outline-secondary">Cancel</a></div>
    </div>
</form></div></div>
@endsection
