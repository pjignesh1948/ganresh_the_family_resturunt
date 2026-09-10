@extends('layouts.front')

@section('title', 'Home — Ganesh The Family Restaurant')

@section('content')
@if($sliders->isNotEmpty())
<section class="hero-slider mb-0">
    <div id="homeCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="4500">
        <div class="carousel-indicators">
            @foreach($sliders as $i => $slide)
            <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="{{ $i }}" @if($i===0) class="active" @endif></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach($sliders as $i => $slide)
            <div class="carousel-item @if($i===0) active @endif">
                <div class="slider-bg" style="background-image:url('{{ \App\Providers\AppServiceProvider::mediaUrl($slide->image) }}')"></div>
                <div class="carousel-caption slider-caption">
                    @if($slide->title)<h2 class="brand-font fw-bold">{{ $slide->title }}</h2>@endif
                    @if($slide->subtitle)<p class="mb-3">{{ $slide->subtitle }}</p>@endif
                    @if($slide->link)
                        <a href="{{ $slide->link }}" class="btn btn-gold">Learn More</a>
                    @else
                        <a href="{{ route('front.order') }}" class="btn btn-gold me-2"><i class="bi bi-bag-check"></i> Order Now</a>
                        <a href="{{ route('front.contact') }}" class="btn btn-outline-light">Contact</a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
        <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
    </div>
</section>
@else
<section class="hero-section py-5">
    <div class="container text-center py-4">
        <img src="{{ asset('images/logo-icon.png') }}" alt="Logo" class="mb-3" style="max-height:140px">
        <h1 class="brand-font text-primary-custom">Ganesh The Family Restaurant</h1>
        <p class="lead text-muted">Umbadiyu Specialist · Gota, Ahmedabad</p>
        <a href="{{ route('front.order') }}" class="btn btn-primary-custom btn-lg"><i class="bi bi-bag-check"></i> Order Online</a>
    </div>
</section>
@endif

<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <h2 class="section-title brand-font">{{ $page?->title ?? 'Welcome' }}</h2>
                @if($page?->content)
                    <div class="content-body text-muted">{!! $page->content !!}</div>
                @endif
                <div class="d-flex flex-wrap gap-2 mt-4">
                    <a href="{{ route('front.order') }}" class="btn btn-primary-custom"><i class="bi bi-cart3"></i> Order Food</a>
                    <a href="{{ route('front.vegetables') }}" class="btn btn-gold"><i class="bi bi-calculator"></i> Veg Calculator</a>
                    <a href="{{ route('front.team') }}" class="btn btn-outline-secondary"><i class="bi bi-people"></i> Our Team</a>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="row g-3">
                    <div class="col-6"><div class="feature-box p-3 text-center"><i class="bi bi-egg-fried fs-2 text-warning"></i><p class="small mb-0 mt-2">Dosa Specialist</p></div></div>
                    <div class="col-6"><div class="feature-box p-3 text-center"><i class="bi bi-fire fs-2 text-danger"></i><p class="small mb-0 mt-2">Umbadiyu</p></div></div>
                    <div class="col-6"><div class="feature-box p-3 text-center"><i class="bi bi-truck fs-2 text-success"></i><p class="small mb-0 mt-2">Online Order</p></div></div>
                    <div class="col-6"><div class="feature-box p-3 text-center"><i class="bi bi-flower1 fs-2 text-success"></i><p class="small mb-0 mt-2">Fresh Vegetables</p></div></div>
                </div>
            </div>
        </div>
    </div>
</section>

@if($featuredItems->isNotEmpty())
<section class="py-5 bg-white">
    <div class="container">
        <h2 class="section-title brand-font mb-4"><i class="bi bi-star-fill text-warning"></i> Popular Dishes</h2>
        <div class="row g-3">
            @foreach($featuredItems as $item)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card card-menu h-100 border-0 shadow-sm overflow-hidden">
                    <img src="{{ \App\Providers\AppServiceProvider::mediaUrl($item->image) }}" class="card-img-top" alt="{{ $item->name }}" style="height:120px;object-fit:cover">
                    <div class="card-body">
                        <span class="badge bg-success mb-1"><i class="bi bi-leaf"></i> Veg</span>
                        <h6 class="fw-semibold mb-1">{{ $item->name }}</h6>
                        <p class="fw-bold text-primary-custom mb-2">₹{{ number_format($item->price, 0) }}</p>
                        <a href="{{ route('front.order') }}" class="btn btn-sm btn-outline-danger w-100"><i class="bi bi-bag-plus"></i> Order</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if(isset($reviews) && $reviews->isNotEmpty())
<section class="py-5 bg-gold-light">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="section-title brand-font mb-2"><i class="bi bi-google"></i> Google Reviews</h2>
            <p class="text-muted mb-0">What our guests say about Umbadiyu &amp; our food</p>
        </div>
        <div class="row g-4">
            @foreach($reviews as $review)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm review-card">
                    <div class="card-body">
                        <div class="d-flex align-items-start gap-3 mb-3">
                            <div class="review-avatar">{{ strtoupper(substr($review->reviewer_name, 0, 1)) }}</div>
                            <div class="flex-grow-1">
                                <div class="fw-semibold">{{ $review->reviewer_name }}</div>
                                <div class="text-warning small">
                                    @for($s = 1; $s <= 5; $s++)
                                        <i class="bi bi-star{{ $s <= $review->rating ? '-fill' : '' }}"></i>
                                    @endfor
                                </div>
                                @if($review->reviewed_ago)
                                    <div class="text-muted small">{{ $review->reviewed_ago }}</div>
                                @endif
                            </div>
                            <span class="badge bg-light text-dark border"><i class="bi bi-google"></i> Google</span>
                        </div>
                        <p class="mb-3 text-muted">"{{ $review->comment }}"</p>
                        @if($review->food_rating || $review->service_rating || $review->atmosphere_rating)
                        <div class="d-flex flex-wrap gap-2">
                            @if($review->food_rating)<span class="badge bg-success-subtle text-success border">Food {{ $review->food_rating }}/5</span>@endif
                            @if($review->service_rating)<span class="badge bg-primary-subtle text-primary border">Service {{ $review->service_rating }}/5</span>@endif
                            @if($review->atmosphere_rating)<span class="badge bg-warning-subtle text-dark border">Atmosphere {{ $review->atmosphere_rating }}/5</span>@endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="py-5 bg-primary-soft text-center">
    <div class="container">
        <h2 class="brand-font text-primary-custom"><i class="bi bi-geo-alt-fill"></i> Visit Us in Gota</h2>
        <p class="mb-3">In front of Rangoli, Beside Magnate Luxuria, Jagatpur Road · 382481</p>
        <p><i class="bi bi-telephone"></i> 9276819283 · 8200692794 · info@ganeshtfr.com</p>
        <a href="{{ route('front.order') }}" class="btn btn-gold btn-lg mt-2"><i class="bi bi-bag-check"></i> Order Now</a>
    </div>
</section>
@endsection

@push('styles')
<style>
.hero-slider { position:relative; }
.slider-bg { height:420px; background-size:cover; background-position:center; filter:brightness(.75); }
.slider-caption { bottom:20%; text-shadow:0 2px 8px rgba(0,0,0,.6); }
.feature-box { background:#fff; border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,.06); }
.review-card { border-radius:14px; }
.review-avatar { width:44px;height:44px;border-radius:50%;background:var(--primary);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;flex-shrink:0; }
@@media(max-width:768px){ .slider-bg{ height:280px; } }
</style>
@endpush

@if(isset($promotion) && $promotion)
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    const key = 'ganesh_promo_{{ $promotion->id }}';
    @if($promotion->show_once)
    if (localStorage.getItem(key)) return;
    @endif
    const html = `<div class="modal fade" id="promoModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered modal-lg"><div class="modal-content border-0 overflow-hidden">
        <div class="modal-body p-0 position-relative">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-2 bg-white rounded-circle p-2 shadow" data-bs-dismiss="modal"></button>
            @if($promotion->link)<a href="{{ $promotion->link }}" target="_blank">@endif
            <img src="{{ \App\Providers\AppServiceProvider::mediaUrl($promotion->image) }}" class="w-100" alt="{{ $promotion->title ?? 'Offer' }}">
            @if($promotion->link)</a>@endif
        </div></div></div></div>`;
    document.body.insertAdjacentHTML('beforeend', html);
    const el = document.getElementById('promoModal');
    const m = new bootstrap.Modal(el);
    m.show();
    el.addEventListener('hidden.bs.modal', function(){ localStorage.setItem(key,'1'); el.remove(); });
});
</script>
@endpush
@endif
