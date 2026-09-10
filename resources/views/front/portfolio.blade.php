@extends('layouts.front')

@section('title', 'Portfolio — Ganesh The Family Restaurant')

@section('content')
<section class="py-5">
    <div class="container">
        <h1 class="section-title mb-4">Our Portfolio</h1>
        <div class="row g-4">
            @forelse($items as $item)
                <div class="col-sm-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100 overflow-hidden">
                        @if($item->image)
                            <img src="{{ \App\Providers\AppServiceProvider::mediaUrl($item->image) }}" class="card-img-top" alt="{{ $item->title }}" style="height: 220px; object-fit: cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 220px;">
                                <i class="bi bi-image fs-1 text-muted"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            @if($item->event_date)
                                <p class="text-muted small mb-2"><i class="bi bi-calendar3 me-1"></i>{{ $item->event_date->format('F j, Y') }}</p>
                            @endif
                            @if($item->description)
                                <p class="card-text small">{{ $item->description }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">No portfolio items to display yet.</div>
                </div>
            @endforelse
        </div>
        @if($items->hasPages())
            <div class="mt-4 d-flex justify-content-center">{{ $items->links() }}</div>
        @endif
    </div>
</section>
@endsection
