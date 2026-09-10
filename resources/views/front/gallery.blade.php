@extends('layouts.front')

@section('title', 'Gallery — Ganesh The Family Restaurant')

@push('styles')
<style>
    .gallery-item { cursor: pointer; transition: transform .2s; }
    .gallery-item:hover { transform: scale(1.02); }
    .lightbox-overlay {
        display: none; position: fixed; inset: 0; background: rgba(0,0,0,.9);
        z-index: 9999; align-items: center; justify-content: center; padding: 1rem;
    }
    .lightbox-overlay.show { display: flex; }
    .lightbox-overlay img { max-width: 100%; max-height: 90vh; object-fit: contain; }
</style>
@endpush

@section('content')
<section class="py-5">
    <div class="container">
        <h1 class="section-title mb-4">Photo Gallery</h1>
        @forelse($categories as $category)
            @if($category->galleryImages->isNotEmpty())
                <div class="mb-5">
                    <h3 class="h5 text-maroon mb-3">{{ $category->name }}</h3>
                    <div class="row g-3">
                        @foreach($category->galleryImages as $image)
                            <div class="col-6 col-md-4 col-lg-3">
                                <div class="gallery-item rounded overflow-hidden shadow-sm"
                                     data-src="{{ \App\Providers\AppServiceProvider::mediaUrl($image->image) }}"
                                     data-title="{{ $image->title ?? '' }}"
                                     data-caption="{{ $image->caption ?? '' }}">
                                    <img src="{{ \App\Providers\AppServiceProvider::mediaUrl($image->image) }}" alt="{{ $image->title ?? 'Gallery' }}"
                                         class="img-fluid w-100" style="height: 180px; object-fit: cover;">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @empty
            <div class="alert alert-info">Gallery coming soon.</div>
        @endforelse
    </div>
</section>

<div class="lightbox-overlay" id="lightbox">
    <button type="button" class="btn btn-light position-absolute top-0 end-0 m-3" id="lightboxClose">&times;</button>
    <div class="text-center">
        <img src="" alt="" id="lightboxImg">
        <p class="text-white mt-2 mb-0" id="lightboxCaption"></p>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightboxImg');
    const lightboxCaption = document.getElementById('lightboxCaption');

    document.querySelectorAll('.gallery-item').forEach(function (el) {
        el.addEventListener('click', function () {
            lightboxImg.src = el.dataset.src;
            lightboxCaption.textContent = el.dataset.title || el.dataset.caption || '';
            lightbox.classList.add('show');
        });
    });

    document.getElementById('lightboxClose').addEventListener('click', function () {
        lightbox.classList.remove('show');
    });
    lightbox.addEventListener('click', function (e) {
        if (e.target === lightbox) lightbox.classList.remove('show');
    });
});
</script>
@endpush
