<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ganesh The Family Restaurant')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #C62828;
            --primary-soft: #FFEBEE;
            --gold: #F9A825;
            --gold-light: #FFF8E1;
            --cream: #FFFBF5;
            --text: #3E2723;
            --text-muted: #6D4C41;
        }
        body { font-family: 'Poppins', sans-serif; background: var(--cream); color: var(--text); }
        h1, h2, h3, .brand-font { font-family: 'Playfair Display', serif; }
        .navbar { background: #fff !important; box-shadow: 0 2px 16px rgba(198,40,40,.08); }
        .navbar-brand img { height: 56px; width: auto; max-width: 220px; object-fit: contain; }
        .navbar .nav-link { color: var(--text) !important; font-weight: 500; }
        .navbar .nav-link:hover, .navbar .nav-link.active { color: var(--primary) !important; }
        .btn-primary-custom { background: var(--primary); color: #fff; border: none; font-weight: 600; }
        .btn-primary-custom:hover { background: #B71C1C; color: #fff; }
        .btn-gold { background: var(--gold); color: var(--text); border: none; font-weight: 600; }
        .btn-gold:hover { background: #F57F17; color: #fff; }
        .text-primary-custom { color: var(--primary); }
        .bg-primary-soft { background: var(--primary-soft); }
        .bg-gold-light { background: var(--gold-light); }
        .section-title { color: var(--primary); font-weight: 700; }
        .section-title::after { content: ''; display: block; width: 50px; height: 3px; background: var(--gold); margin-top: .5rem; border-radius: 2px; }
        .hero-section {
            background: linear-gradient(135deg, #fff 0%, var(--gold-light) 50%, var(--primary-soft) 100%);
            border-bottom: 3px solid var(--gold);
        }
        footer { background: #fff; border-top: 3px solid var(--gold); color: var(--text); }
        footer a { color: var(--primary); text-decoration: none; }
        footer a:hover { color: var(--gold); }
        .content-body ul { padding-left: 1.2rem; }
        .content-body p { margin-bottom: 1rem; }
        .card-menu { border: none; border-radius: 12px; transition: transform .25s ease, box-shadow .25s ease; overflow: hidden; }
        .card-menu:hover { transform: translateY(-6px); box-shadow: 0 14px 32px rgba(198,40,40,.14); }
        .card-menu .card-img-top { transition: transform .35s ease; }
        .card-menu:hover .card-img-top { transform: scale(1.06); }
        .menu-hover-overlay { position:absolute; inset:0; background:linear-gradient(to top,rgba(0,0,0,.55),transparent); opacity:0; transition:opacity .3s; display:flex; align-items:flex-end; padding:.75rem; }
        .card-menu:hover .menu-hover-overlay { opacity:1; }
        .menu-img-wrap { position:relative; overflow:hidden; }
        .cart-bar { background: #fff; border-top: 2px solid var(--gold); box-shadow: 0 -4px 20px rgba(0,0,0,.1); }
    </style>
    @stack('styles')
</head>
<body>
    @php $site = \App\Models\SiteSetting::class; @endphp
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('front.home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Ganesh The Family Restaurant">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto gap-lg-1">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('front.home') ? 'active' : '' }}" href="{{ route('front.home') }}"><i class="bi bi-house-door me-1"></i> Home</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('front.about') ? 'active' : '' }}" href="{{ route('front.about') }}"><i class="bi bi-info-circle me-1"></i> About</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('front.team') ? 'active' : '' }}" href="{{ route('front.team') }}"><i class="bi bi-people me-1"></i> Our Team</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('front.order*') ? 'active' : '' }}" href="{{ route('front.order') }}"><i class="bi bi-bag-check me-1"></i> Order</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('front.portfolio') ? 'active' : '' }}" href="{{ route('front.portfolio') }}"><i class="bi bi-images me-1"></i> Portfolio</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('front.gallery') ? 'active' : '' }}" href="{{ route('front.gallery') }}"><i class="bi bi-camera me-1"></i> Gallery</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('front.videos') ? 'active' : '' }}" href="{{ route('front.videos') }}"><i class="bi bi-play-btn me-1"></i> Videos</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('front.vegetables*') ? 'active' : '' }}" href="{{ route('front.vegetables') }}"><i class="bi bi-calculator me-1"></i> Veg Calc</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('front.contact*') ? 'active' : '' }}" href="{{ route('front.contact') }}"><i class="bi bi-envelope me-1"></i> Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show m-0 rounded-0 text-center border-0" role="alert">
            <i class="bi bi-check-circle me-1"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <main>@yield('content')</main>

    <footer class="py-5 mt-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <img src="{{ asset('images/logo-icon.png') }}" alt="Logo" height="72" class="mb-3">
                    <p class="text-muted mb-0">{{ $site::get('tagline') }}</p>
                    <p class="small text-muted mt-2 mb-0"><em>Umbadiyu Specialist</em></p>
                </div>
                <div class="col-md-4">
                    <h5 class="text-primary-custom mb-3">Contact Us</h5>
                    @if($site::get('phone'))
                        <p class="mb-1"><i class="bi bi-telephone-fill text-warning me-2"></i>
                            @foreach(explode(',', $site::get('phone')) as $p)
                                <a href="tel:{{ trim($p) }}">{{ trim($p) }}</a>@if(!$loop->last), @endif
                            @endforeach
                        </p>
                    @endif
                    @if($site::get('email'))
                        <p class="mb-1"><i class="bi bi-envelope-fill text-warning me-2"></i><a href="mailto:{{ $site::get('email') }}">{{ $site::get('email') }}</a></p>
                    @endif
                    @if($site::get('address'))
                        <p class="mb-1"><i class="bi bi-geo-alt-fill text-warning me-2"></i>{{ $site::get('address') }}</p>
                    @endif
                    @if($site::get('opening_hours'))
                        <p class="mb-0"><i class="bi bi-clock-fill text-warning me-2"></i>{{ $site::get('opening_hours') }}</p>
                    @endif
                </div>
                <div class="col-md-4">
                    <h5 class="text-primary-custom mb-3">Quick Links</h5>
                    <div class="d-flex flex-column gap-1">
                        <a href="{{ route('front.order') }}"><i class="bi bi-bag-check me-1"></i> Order Online</a>
                        <a href="{{ route('front.team') }}"><i class="bi bi-people me-1"></i> Our Team</a>
                        <a href="{{ route('front.vegetables') }}"><i class="bi bi-calculator me-1"></i> Vegetable Calculator</a>
                        <a href="{{ route('front.contact') }}"><i class="bi bi-envelope me-1"></i> Contact</a>
                    </div>
                    @if($site::get('whatsapp_number'))
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $site::get('whatsapp_number')) }}" class="btn btn-success btn-sm mt-3" target="_blank">
                            <i class="bi bi-whatsapp"></i> WhatsApp Us
                        </a>
                    @endif
                </div>
            </div>
            <hr class="my-4">
            <p class="text-center mb-0 small text-muted">&copy; {{ date('Y') }} Ganesh The Family Restaurant · Gota, Ahmedabad</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
