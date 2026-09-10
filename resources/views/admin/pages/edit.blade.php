@extends('layouts.admin')

@section('title', 'Edit ' . ucfirst($page->slug) . ' Page')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Edit {{ ucfirst($page->slug) }} Page</h1>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ $page->slug === 'home' ? route('admin.pages.home.update') : route('admin.pages.about.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Title *</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $page->title) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content" class="form-control" rows="10">{{ old('content', $page->content) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Meta Title</label>
                <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $page->meta_title) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Meta Description</label>
                <textarea name="meta_description" class="form-control" rows="2">{{ old('meta_description', $page->meta_description) }}</textarea>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="is_published" value="1" class="form-check-input" id="is_published" {{ old('is_published', $page->is_published) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_published">Published</label>
            </div>
            <button type="submit" class="btn btn-maroon">Update Page</button>
        </form>
    </div>
</div>
@endsection
