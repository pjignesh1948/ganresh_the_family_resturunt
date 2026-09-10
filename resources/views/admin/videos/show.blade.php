@extends('layouts.admin')

@section('title', $video->title)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">{{ $video->title }}</h1>
    <a href="{{ route('admin.videos.edit', $video) }}" class="btn btn-maroon">Edit</a>
</div>
<div class="row g-4">
    <div class="col-md-8">
        <div class="ratio ratio-16x9 mb-3">
            @if($video->youtubeEmbedUrl())
                <iframe src="{{ $video->youtubeEmbedUrl() }}" title="{{ $video->title }}" allowfullscreen></iframe>
            @elseif($video->video_file)
                <video controls class="w-100" @if($video->thumbnail) poster="{{ asset('storage/'.$video->thumbnail) }}" @endif><source src="{{ asset('storage/'.$video->video_file) }}"></video>
            @else
                <div class="bg-light d-flex align-items-center justify-content-center">No preview</div>
            @endif
        </div>
    </div>
    <div class="col-md-4"><div class="card shadow-sm"><div class="card-body">
        <p><strong>Category:</strong> {{ $video->videoCategory?->name ?? '—' }}</p>
        <p><strong>Status:</strong> {{ $video->is_active ? 'Active' : 'Inactive' }}</p>
        @if($video->description)<p>{{ $video->description }}</p>@endif
    </div></div></div>
</div>
<a href="{{ route('admin.videos.index') }}" class="btn btn-outline-secondary mt-3">Back</a>
@endsection
