@extends('layouts.admin')

@section('title', $galleryImage->title ?? 'Gallery Image')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">{{ $galleryImage->title ?? 'Gallery Image' }}</h1>
    <a href="{{ route('admin.gallery-images.edit', $galleryImage) }}" class="btn btn-maroon">Edit</a>
</div>
<div class="row"><div class="col-md-6"><img src="{{ asset('storage/'.$galleryImage->image) }}" class="img-fluid rounded shadow-sm mb-3">
<p><strong>Category:</strong> {{ $galleryImage->galleryCategory?->name ?? '—' }}</p>
@if($galleryImage->caption)<p>{{ $galleryImage->caption }}</p>@endif
</div></div>
<a href="{{ route('admin.gallery-images.index') }}" class="btn btn-outline-secondary mt-3">Back</a>
@endsection
