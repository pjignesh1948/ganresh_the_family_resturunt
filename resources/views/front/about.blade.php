@extends('layouts.front')

@section('title', ($page?->meta_title ?? $page?->title ?? 'About Us') . ' — Ganesh The Family Restaurant')

@section('content')
<section class="py-5 bg-gold-light">
    <div class="container text-center">
        <h1 class="section-title brand-font d-inline-block">{{ $page?->title ?? 'About Us' }}</h1>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-9">
                @if($page?->content)
                    <div class="content-body fs-5">{!! $page->content !!}</div>
                @endif
            </div>
        </div>

        @if($founders->isNotEmpty())
        <div class="text-center mb-4">
            <h2 class="section-title brand-font d-inline-block"><i class="bi bi-stars text-warning"></i> Our Founders</h2>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach($founders as $founder)
            <div class="col-md-5 col-lg-4">
                <div class="card card-menu border-0 shadow-sm h-100 text-center overflow-hidden founder-card">
                    @if($founder->photo)
                        <img src="{{ \App\Providers\AppServiceProvider::mediaUrl($founder->photo) }}" class="card-img-top" alt="{{ $founder->name }}" style="height:260px;object-fit:cover">
                    @endif
                    <div class="card-body p-4">
                        <h4 class="fw-bold text-primary-custom mb-1">{{ $founder->name }}</h4>
                        @if($founder->title)<p class="text-warning fw-medium mb-2"><i class="bi bi-award"></i> {{ $founder->title }}</p>@endif
                        @if($founder->bio)<p class="text-muted mb-0">{{ $founder->bio }}</p>@endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endsection

@push('styles')
<style>
.founder-card:hover { transform: translateY(-6px); box-shadow: 0 16px 32px rgba(198,40,40,.12)!important; }
.founder-card .card-img-top { transition: transform .35s ease; }
.founder-card:hover .card-img-top { transform: scale(1.04); }
</style>
@endpush
