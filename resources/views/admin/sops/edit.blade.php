@extends('layouts.admin')

@section('title', 'Edit SOP')

@section('content')
<div class="mb-4"><h1 class="h3 mb-0">Edit SOP</h1></div>
<div class="card shadow-sm"><div class="card-body">
<form action="{{ route('admin.sops.update', $sop) }}" method="POST" enctype="multipart/form-data">@csrf @method('PUT')
    <div class="mb-3"><label class="form-label">Title *</label><input type="text" name="title" class="form-control" value="{{ old('title', $sop->title) }}" required></div>
    <div class="mb-3"><label class="form-label">Category</label><input type="text" name="category" class="form-control" value="{{ old('category', $sop->category) }}"></div>
    <div class="mb-3"><label class="form-label">Content</label><textarea name="content" class="form-control" rows="8">{{ old('content', $sop->content) }}</textarea></div>
    <div class="mb-3"><label class="form-label">Document</label>@if($sop->document)<p class="small"><a href="{{ asset('storage/'.$sop->document) }}" target="_blank">Current document</a></p>@endif<input type="file" name="document" class="form-control" accept=".pdf,.doc,.docx"></div>
    <div class="mb-3"><label class="form-label">Version</label><input type="text" name="version" class="form-control" value="{{ old('version', $sop->version) }}"></div>
    <div class="mb-3 form-check"><input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active" {{ old('is_active', $sop->is_active) ? 'checked' : '' }}><label class="form-check-label" for="is_active">Active</label></div>
    <button type="submit" class="btn btn-maroon">Update</button> <a href="{{ route('admin.sops.index') }}" class="btn btn-outline-secondary">Cancel</a>
</form></div></div>
@endsection
