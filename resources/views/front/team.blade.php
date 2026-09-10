@extends('layouts.front')

@section('title', 'Our Team — Ganesh The Family Restaurant')

@section('content')
<section class="py-5 bg-gold-light">
    <div class="container text-center">
        <h1 class="section-title brand-font d-inline-block"><i class="bi bi-people-fill"></i> Our Team</h1>
        <p class="text-muted mt-3">Meet the people behind Ganesh The Family Restaurant</p>
    </div>
</section>
<section class="py-5">
    <div class="container">
        <div class="row g-4 justify-content-center">
            @forelse($members as $member)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card border-0 shadow-sm h-100 text-center card-menu">
                    <div class="card-body p-4">
                        @if($member->photo)
                            <img src="{{ \App\Providers\AppServiceProvider::mediaUrl($member->photo) }}" class="rounded-circle mb-3" width="100" height="100" style="object-fit:cover" alt="{{ $member->name }}">
                        @else
                            <div class="rounded-circle bg-primary-soft d-inline-flex align-items-center justify-content-center mb-3" style="width:100px;height:100px">
                                <span class="fs-2 fw-bold text-primary-custom">{{ strtoupper(substr($member->name,0,1)) }}</span>
                            </div>
                        @endif
                        <h5 class="fw-semibold mb-1">{{ $member->name }}</h5>
                        @if($member->role)<p class="text-warning fw-medium mb-2"><i class="bi bi-briefcase"></i> {{ $member->role }}</p>@endif
                        @if($member->bio)<p class="small text-muted mb-2">{{ $member->bio }}</p>@endif
                        @if($member->phone)<a href="tel:{{ $member->phone }}" class="small"><i class="bi bi-telephone"></i> {{ $member->phone }}</a>@endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted py-5">Team information coming soon.</div>
            @endforelse
        </div>
    </div>
</section>
@endsection
