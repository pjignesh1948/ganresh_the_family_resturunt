@extends('layouts.admin')

@section('title', $galleryCategory->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">{{ $galleryCategory->name }}</h1>
    <a href="{{ route('admin.gallery-categories.edit', $galleryCategory) }}" class="btn btn-maroon">Edit</a>
</div>
<div class="row g-3">
    @forelse($galleryCategory->galleryImages as $image)
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card shadow-sm"><img src="{{ asset('storage/'.$image->image) }}" class="card-img-top" style="height:140px;object-fit:cover;" alt="{{ $image->title }}"><div class="card-body p-2"><small>{{ $image->title ?? 'Untitled' }}</small></div></div>
        </div>
    @empty
        <div class="col-12 text-muted">No images in this category.</div>
    @endforelse
</div>
<a href="{{ route('admin.gallery-categories.index') }}" class="btn btn-outline-secondary mt-3">Back</a>
@endsection
