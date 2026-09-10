@extends('layouts.admin')

@section('title', 'Add Video')

@section('content')
<div class="mb-4"><h1 class="h3 mb-0">Add Video</h1></div>
<div class="card shadow-sm"><div class="card-body">
<form action="{{ route('admin.videos.store') }}" method="POST" enctype="multipart/form-data">@csrf
    <div class="mb-3"><label class="form-label">Category</label><select name="video_category_id" class="form-select"><option value="">None</option>@foreach($categories as $cat)<option value="{{ $cat->id }}" {{ old('video_category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>@endforeach</select></div>
    <div class="mb-3"><label class="form-label">Title *</label><input type="text" name="title" class="form-control" value="{{ old('title') }}" required></div>
    <div class="mb-3"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea></div>
    <div class="mb-3"><label class="form-label">YouTube URL</label><input type="url" name="youtube_url" class="form-control" value="{{ old('youtube_url') }}" placeholder="https://youtube.com/watch?v=..."></div>
    <div class="mb-3"><label class="form-label">Video File (mp4/webm)</label><input type="file" name="video_file" class="form-control" accept="video/*"></div>
    <div class="mb-3"><label class="form-label">Thumbnail</label><input type="file" name="thumbnail" class="form-control" accept="image/*"></div>
    <div class="mb-3"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" min="0"></div>
    <div class="mb-3 form-check"><input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active" checked><label class="form-check-label" for="is_active">Active</label></div>
    <button type="submit" class="btn btn-maroon">Create</button> <a href="{{ route('admin.videos.index') }}" class="btn btn-outline-secondary">Cancel</a>
</form></div></div>
@endsection
