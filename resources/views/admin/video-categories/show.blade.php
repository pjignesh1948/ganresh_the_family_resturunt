@extends('layouts.admin')

@section('title', $videoCategory->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">{{ $videoCategory->name }}</h1>
    <a href="{{ route('admin.video-categories.edit', $videoCategory) }}" class="btn btn-maroon">Edit</a>
</div>
<div class="table-responsive"><table class="table"><thead><tr><th>Title</th><th>Status</th><th></th></tr></thead>
<tbody>@forelse($videoCategory->videos as $video)<tr><td>{{ $video->title }}</td><td>{{ $video->is_active ? 'Active' : 'Inactive' }}</td><td><a href="{{ route('admin.videos.show', $video) }}" class="btn btn-sm btn-outline-primary">View</a></td></tr>@empty<tr><td colspan="3" class="text-muted">No videos.</td></tr>@endforelse</tbody></table></div>
<a href="{{ route('admin.video-categories.index') }}" class="btn btn-outline-secondary mt-3">Back</a>
@endsection
