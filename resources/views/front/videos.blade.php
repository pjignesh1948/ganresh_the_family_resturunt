@extends('layouts.front')

@section('title', 'Videos — Ganesh The Family Restaurant')

@section('content')
<section class="py-5">
    <div class="container">
        <h1 class="section-title mb-4">Videos</h1>
        @forelse($categories as $category)
            @if($category->videos->isNotEmpty())
                <div class="mb-5">
                    <h3 class="h5 text-maroon mb-3">{{ $category->name }}</h3>
                    <div class="row g-4">
                        @foreach($category->videos as $video)
                            <div class="col-md-6 col-lg-4">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="ratio ratio-16x9">
                                        @if($video->youtubeEmbedUrl())
                                            <iframe src="{{ $video->youtubeEmbedUrl() }}" title="{{ $video->title }}"
                                                    allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
                                        @elseif($video->video_file)
                                            <video controls class="w-100 h-100" @if($video->thumbnail) poster="{{ asset('storage/'.$video->thumbnail) }}" @endif>
                                                <source src="{{ asset('storage/'.$video->video_file) }}">
                                            </video>
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center">
                                                <i class="bi bi-play-circle fs-1 text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-title">{{ $video->title }}</h6>
                                        @if($video->description)
                                            <p class="card-text small text-muted">{{ Str::limit($video->description, 100) }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @empty
            <div class="alert alert-info">No videos available yet.</div>
        @endforelse
    </div>
</section>
@endsection
