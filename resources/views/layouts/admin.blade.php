<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Ganesh Restaurant</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --bg-body: #1e293b;
            --bg-sidebar: #0f172a;
            --bg-card: #334155;
            --bg-card-hover: #3d4f66;
            --text-primary: #e2e8f0;
            --text-muted: #94a3b8;
            --accent-amber: #f59e0b;
            --accent-indigo: #818cf8;
            --border-color: rgba(148, 163, 184, 0.15);
            --sidebar-w: 260px;
        }

        body {
            background: var(--bg-body);
            color: var(--text-primary);
            min-height: 100vh;
        }

        .admin-sidebar {
            width: var(--sidebar-w);
            background: var(--bg-sidebar);
            color: var(--text-primary);
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1030;
            overflow-y: auto;
            border-right: 1px solid var(--border-color);
        }

        .admin-sidebar .brand {
            padding: 1.25rem;
            border-bottom: 1px solid var(--border-color);
        }

        .admin-sidebar .brand img {
            height: 72px;
            width: 72px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid rgba(245, 158, 11, 0.45);
        }

        .admin-sidebar .nav-link {
            color: var(--text-muted);
            padding: .6rem 1.25rem;
            font-size: .9rem;
            border-left: 3px solid transparent;
            transition: all .2s ease;
        }

        .admin-sidebar .nav-link:hover,
        .admin-sidebar .nav-link.active {
            color: var(--text-primary);
            background: rgba(129, 140, 248, 0.12);
            border-left-color: var(--accent-amber);
        }

        .admin-sidebar .nav-link.active i {
            color: var(--accent-amber);
        }

        .admin-sidebar .nav-section {
            font-size: .68rem;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: rgba(148, 163, 184, 0.55);
            padding: 1rem 1.25rem .35rem;
            font-weight: 600;
        }

        .admin-sidebar .nav-link.btn-link {
            color: var(--text-muted);
            text-decoration: none;
        }

        .admin-sidebar .nav-link.btn-link:hover {
            color: #f87171;
            background: rgba(248, 113, 113, 0.1);
            border-left-color: #f87171;
        }

        .admin-content {
            margin-left: var(--sidebar-w);
            padding: 1.5rem;
        }

        @@media (max-width: 991.98px) {
            .admin-sidebar { transform: translateX(-100%); transition: transform .3s; width: var(--sidebar-w); }
            .admin-content { margin-left: 0; }
        }

        /* Cards */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
        }

        .card-header {
            background: rgba(15, 23, 42, 0.4);
            border-bottom: 1px solid var(--border-color);
            color: var(--text-primary);
        }

        .card-footer {
            background: rgba(15, 23, 42, 0.3);
            border-top: 1px solid var(--border-color);
        }

        /* Stats */
        .card-stat {
            border-left: 4px solid var(--accent-amber);
        }

        .card-stat .text-muted,
        .text-muted {
            color: var(--text-muted) !important;
        }

        /* Module cards */
        .module-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: .75rem;
            padding: 1.25rem;
            text-decoration: none;
            color: var(--text-primary);
            display: block;
            transition: all .2s ease;
            height: 100%;
        }

        .module-card:hover {
            background: var(--bg-card-hover);
            border-color: var(--accent-indigo);
            transform: translateY(-2px);
            color: var(--text-primary);
        }

        .module-card .module-icon {
            width: 44px;
            height: 44px;
            border-radius: .6rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin-bottom: .75rem;
        }

        .module-card .module-count {
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1.2;
        }

        .module-card .module-label {
            font-size: .85rem;
            color: var(--text-muted);
        }

        /* Buttons */
        .btn-accent {
            background: var(--accent-amber);
            color: #0f172a;
            border: none;
            font-weight: 600;
        }

        .btn-accent:hover,
        .btn-accent:focus {
            background: #d97706;
            color: #0f172a;
        }

        .btn-maroon {
            background: var(--accent-amber);
            color: #0f172a;
            border: none;
            font-weight: 600;
        }

        .btn-maroon:hover,
        .btn-maroon:focus {
            background: #d97706;
            color: #0f172a;
        }

        .btn-outline-accent {
            border-color: var(--accent-indigo);
            color: var(--accent-indigo);
        }

        .btn-outline-accent:hover {
            background: var(--accent-indigo);
            color: #0f172a;
        }

        /* Forms */
        .form-control,
        .form-select {
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
        }

        .form-control:focus,
        .form-select:focus {
            background: rgba(15, 23, 42, 0.7);
            border-color: var(--accent-indigo);
            color: var(--text-primary);
            box-shadow: 0 0 0 .2rem rgba(129, 140, 248, 0.25);
        }

        .form-control::placeholder {
            color: rgba(148, 163, 184, 0.6);
        }

        .form-label {
            color: var(--text-primary);
            font-weight: 500;
        }

        .form-check-input {
            background-color: rgba(15, 23, 42, 0.5);
            border-color: var(--border-color);
        }

        .form-check-input:checked {
            background-color: var(--accent-indigo);
            border-color: var(--accent-indigo);
        }

        .form-check-label {
            color: var(--text-muted);
        }

        /* Tables */
        .table {
            --bs-table-bg: transparent;
            --bs-table-color: var(--text-primary);
            --bs-table-border-color: var(--border-color);
            --bs-table-hover-bg: rgba(129, 140, 248, 0.08);
            --bs-table-hover-color: var(--text-primary);
            color: var(--text-primary);
        }

        .table thead th {
            background: rgba(15, 23, 42, 0.5);
            color: var(--text-muted);
            font-size: .8rem;
            text-transform: uppercase;
            letter-spacing: .04em;
            border-bottom: 1px solid var(--border-color);
            font-weight: 600;
        }

        .table td {
            border-color: var(--border-color);
            vertical-align: middle;
        }

        /* Alerts */
        .alert-success {
            background: rgba(34, 197, 94, 0.15);
            border-color: rgba(34, 197, 94, 0.3);
            color: #86efac;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.15);
            border-color: rgba(239, 68, 68, 0.3);
            color: #fca5a5;
        }

        .btn-close {
            filter: invert(1) grayscale(1);
        }

        /* Badges */
        .badge.bg-secondary {
            background: rgba(148, 163, 184, 0.25) !important;
            color: var(--text-primary);
        }

        .badge.bg-success {
            background: rgba(34, 197, 94, 0.25) !important;
            color: #86efac;
        }

        .badge.bg-warning {
            background: rgba(245, 158, 11, 0.25) !important;
            color: #fcd34d;
        }

        .badge.bg-danger {
            background: rgba(239, 68, 68, 0.25) !important;
            color: #fca5a5;
        }

        /* Pagination */
        .pagination {
            --bs-pagination-bg: var(--bg-card);
            --bs-pagination-border-color: var(--border-color);
            --bs-pagination-color: var(--text-muted);
            --bs-pagination-hover-bg: var(--bg-card-hover);
            --bs-pagination-hover-color: var(--text-primary);
            --bs-pagination-active-bg: var(--accent-indigo);
            --bs-pagination-active-border-color: var(--accent-indigo);
            --bs-pagination-disabled-bg: rgba(15, 23, 42, 0.3);
            --bs-pagination-disabled-color: rgba(148, 163, 184, 0.4);
        }

        h1, h2, h3, h4, h5, h6 {
            color: var(--text-primary);
        }

        .btn-outline-secondary {
            border-color: var(--border-color);
            color: var(--text-muted);
        }

        .btn-outline-secondary:hover {
            background: rgba(148, 163, 184, 0.15);
            color: var(--text-primary);
            border-color: var(--text-muted);
        }

        .btn-outline-primary {
            border-color: var(--accent-indigo);
            color: var(--accent-indigo);
        }

        .btn-outline-primary:hover {
            background: var(--accent-indigo);
            color: #0f172a;
        }

        .btn-outline-danger {
            border-color: rgba(239, 68, 68, 0.5);
            color: #fca5a5;
        }

        .btn-outline-danger:hover {
            background: rgba(239, 68, 68, 0.2);
            color: #fca5a5;
        }

        hr {
            border-color: var(--border-color);
        }

        /* Sidebar collapse */
        .admin-sidebar { transition: width .3s ease, transform .3s ease; }
        body.sidebar-collapsed { --sidebar-w: 72px; }
        body.sidebar-collapsed .admin-sidebar .brand-text,
        body.sidebar-collapsed .admin-sidebar .nav-section { display: none; }
        body.sidebar-collapsed .admin-sidebar .nav-link { font-size: 0; text-align: center; padding: .7rem .4rem; }
        body.sidebar-collapsed .admin-sidebar .nav-link i { font-size: 1.15rem; margin: 0 !important; }
        body.sidebar-collapsed .admin-content { margin-left: 72px; }
        .sidebar-toggle { position: absolute; top: 1rem; right: .75rem; z-index: 2; }
        .sidebar-backdrop { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.55); z-index: 1025; }
        body.sidebar-mobile-open .sidebar-backdrop { display: block; }
        body.sidebar-mobile-open .admin-sidebar { transform: translateX(0); }

        /* DataTables dark */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate { color: var(--text-muted); margin-top: .75rem; }
        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_length select {
            background: rgba(15,23,42,.5); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: .375rem; padding: .35rem .5rem;
        }
        table.dataTable thead th { border-bottom-color: var(--border-color) !important; color: var(--text-primary); }
        table.dataTable tbody td { border-color: var(--border-color); color: var(--text-primary); vertical-align: middle; }
        .page-item .page-link { background: var(--bg-card); border-color: var(--border-color); color: var(--text-primary); }
        .page-item.active .page-link { background: var(--accent-amber); border-color: var(--accent-amber); color: #0f172a; }

        /* Order live alerts */
        #orderAlertBar { display:none; position:fixed; top:0; left:0; right:0; z-index:2000; background:linear-gradient(90deg,#dc2626,#f59e0b); color:#fff; padding:.85rem 1.25rem; box-shadow:0 4px 20px rgba(0,0,0,.35); animation: orderPulse 1s ease infinite; }
        #orderAlertBar.show { display:flex; }
        @@keyframes orderPulse { 0%,100%{ opacity:1; } 50%{ opacity:.88; } }
        .order-alert-bell { position:relative; }
        .order-alert-bell .badge { position:absolute; top:-6px; right:-8px; font-size:.65rem; }
        #orderToastStack { position:fixed; top:70px; right:16px; z-index:1999; max-width:360px; }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
    @stack('styles')
</head>
<body>
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="brand position-relative">
            <button type="button" class="btn btn-sm btn-accent sidebar-toggle d-none d-lg-inline-flex" id="sidebarCollapseBtn" title="Toggle sidebar"><i class="bi bi-layout-sidebar"></i></button>
            <img src="{{ asset('images/logo-icon.png') }}" alt="Ganesh Restaurant" class="mb-2">
            <div class="fw-bold small text-white brand-text">Ganesh Admin</div>
        </div>
        <nav class="nav flex-column pb-4">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>

            <div class="nav-section">Menu</div>
            <a class="nav-link {{ request()->routeIs('admin.menu-categories.*') ? 'active' : '' }}" href="{{ route('admin.menu-categories.index') }}">
                <i class="bi bi-folder me-2"></i> Menu Categories
            </a>
            <a class="nav-link {{ request()->routeIs('admin.menu-items.*') ? 'active' : '' }}" href="{{ route('admin.menu-items.index') }}">
                <i class="bi bi-cup-hot me-2"></i> Menu Items
            </a>
            <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
                <i class="bi bi-bag-check me-2"></i> Orders
                <span class="badge bg-danger ms-1 d-none" id="sidebarPendingBadge">0</span>
            </a>

            <div class="nav-section">Inventory</div>
            <a class="nav-link {{ request()->routeIs('admin.vegetables.*') && !request()->routeIs('admin.vegetables.flyer') ? 'active' : '' }}" href="{{ route('admin.vegetables.index') }}">
                <i class="bi bi-flower1 me-2"></i> Vegetables
            </a>
            <a class="nav-link {{ request()->routeIs('admin.vegetables.flyer') ? 'active' : '' }}" href="{{ route('admin.vegetables.flyer') }}">
                <i class="bi bi-image me-2"></i> Daily Price Flyer
            </a>
            <a class="nav-link {{ request()->routeIs('admin.vegetable-sales.*') ? 'active' : '' }}" href="{{ route('admin.vegetable-sales.index') }}">
                <i class="bi bi-cart-check me-2"></i> Vegetable Sales
            </a>

            <div class="nav-section">Staff</div>
            <a class="nav-link {{ request()->routeIs('admin.staff.*') ? 'active' : '' }}" href="{{ route('admin.staff.index') }}">
                <i class="bi bi-people me-2"></i> Staff
            </a>
            <a class="nav-link {{ request()->routeIs('admin.salaries.*') ? 'active' : '' }}" href="{{ route('admin.salaries.index') }}">
                <i class="bi bi-cash-stack me-2"></i> Salary
            </a>
            <a class="nav-link {{ request()->routeIs('admin.team-members.*') ? 'active' : '' }}" href="{{ route('admin.team-members.index') }}">
                <i class="bi bi-person-badge me-2"></i> Team Members
            </a>
            <a class="nav-link {{ request()->routeIs('admin.founders.*') ? 'active' : '' }}" href="{{ route('admin.founders.index') }}">
                <i class="bi bi-star me-2"></i> Founders
            </a>

            <div class="nav-section">Media</div>
            <a class="nav-link {{ request()->routeIs('admin.home-sliders.*') ? 'active' : '' }}" href="{{ route('admin.home-sliders.index') }}">
                <i class="bi bi-images me-2"></i> Home Sliders
            </a>
            <a class="nav-link {{ request()->routeIs('admin.promotions.*') ? 'active' : '' }}" href="{{ route('admin.promotions.index') }}">
                <i class="bi bi-megaphone me-2"></i> Promotions
            </a>
            <a class="nav-link {{ request()->routeIs('admin.gallery-categories.*') ? 'active' : '' }}" href="{{ route('admin.gallery-categories.index') }}">
                <i class="bi bi-collection me-2"></i> Gallery Categories
            </a>
            <a class="nav-link {{ request()->routeIs('admin.gallery-images.*') ? 'active' : '' }}" href="{{ route('admin.gallery-images.index') }}">
                <i class="bi bi-image me-2"></i> Gallery Images
            </a>
            <a class="nav-link {{ request()->routeIs('admin.video-categories.*') ? 'active' : '' }}" href="{{ route('admin.video-categories.index') }}">
                <i class="bi bi-collection-play me-2"></i> Video Categories
            </a>
            <a class="nav-link {{ request()->routeIs('admin.videos.*') ? 'active' : '' }}" href="{{ route('admin.videos.index') }}">
                <i class="bi bi-play-btn me-2"></i> Videos
            </a>
            <a class="nav-link {{ request()->routeIs('admin.portfolios.*') ? 'active' : '' }}" href="{{ route('admin.portfolios.index') }}">
                <i class="bi bi-briefcase me-2"></i> Portfolio
            </a>

            <div class="nav-section">Operations</div>
            <a class="nav-link {{ request()->routeIs('admin.sops.*') ? 'active' : '' }}" href="{{ route('admin.sops.index') }}">
                <i class="bi bi-journal-text me-2"></i> SOPs
            </a>

            <div class="nav-section">Site</div>
            <a class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.edit') }}">
                <i class="bi bi-gear me-2"></i> Settings
            </a>
            <a class="nav-link {{ request()->routeIs('admin.pages.home.*') ? 'active' : '' }}" href="{{ route('admin.pages.home.edit') }}">
                <i class="bi bi-house me-2"></i> Home Page
            </a>
            <a class="nav-link {{ request()->routeIs('admin.pages.about.*') ? 'active' : '' }}" href="{{ route('admin.pages.about.edit') }}">
                <i class="bi bi-info-circle me-2"></i> About Page
            </a>
            <a class="nav-link {{ request()->routeIs('admin.contact-messages.*') ? 'active' : '' }}" href="{{ route('admin.contact-messages.index') }}">
                <i class="bi bi-envelope me-2"></i> Contact Messages
            </a>

            <hr class="mx-3">
            <form action="{{ route('admin.logout') }}" method="POST" class="px-3">
                @csrf
                <button type="submit" class="nav-link btn btn-link text-start w-100 px-0">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </button>
            </form>
        </nav>
    </aside>

    <div class="admin-content">
        <div class="d-flex justify-content-between align-items-center mb-4 d-lg-none">
            <button class="btn btn-accent btn-sm" type="button" id="sidebarMobileBtn">
                <i class="bi bi-list"></i> Menu
            </button>
            <div class="order-alert-bell">
                <button type="button" class="btn btn-outline-secondary btn-sm" id="orderSoundToggle" title="Toggle order voice alerts">
                    <i class="bi bi-volume-up-fill"></i>
                </button>
                <span class="badge bg-danger d-none" id="mobilePendingBadge">0</span>
            </div>
        </div>

        <div id="orderAlertBar" class="align-items-center justify-content-between gap-3 flex-wrap">
            <div class="fw-bold"><i class="bi bi-bell-fill"></i> <span id="orderAlertText">New order received!</span></div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-light fw-semibold">View Orders</a>
                <button type="button" class="btn btn-sm btn-dark" id="orderAlertDismiss">Dismiss</button>
            </div>
        </div>
        <div id="orderToastStack"></div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script>
    (function(){
        const body = document.body;
        const sidebar = document.getElementById('adminSidebar');
        const backdrop = document.getElementById('sidebarBackdrop');
        if (localStorage.getItem('ganesh_admin_sidebar') === 'collapsed') body.classList.add('sidebar-collapsed');
        document.getElementById('sidebarCollapseBtn')?.addEventListener('click', function(){
            body.classList.toggle('sidebar-collapsed');
            localStorage.setItem('ganesh_admin_sidebar', body.classList.contains('sidebar-collapsed') ? 'collapsed' : 'expanded');
        });
        function closeMobile(){ body.classList.remove('sidebar-mobile-open'); }
        document.getElementById('sidebarMobileBtn')?.addEventListener('click', function(){
            body.classList.toggle('sidebar-mobile-open');
        });
        backdrop?.addEventListener('click', closeMobile);
        sidebar?.querySelectorAll('.nav-link[href]').forEach(function(a){
            a.addEventListener('click', function(){ if (window.innerWidth < 992) closeMobile(); });
        });
        $(function(){
            $('.admin-datatable').each(function(){
                if (!$.fn.DataTable.isDataTable(this)) {
                    $(this).DataTable({
                        pageLength: 25,
                        order: [],
                        responsive: true,
                        language: { search: 'Search:', searchPlaceholder: 'Type to filter...', lengthMenu: 'Show _MENU_ rows' }
                    });
                }
            });
        });
    })();
    </script>
    <script>
    (function(){
        const pollUrl = @json(route('admin.orders.poll'));
        const ordersUrl = @json(route('admin.orders.index'));
        let lastSeenId = parseInt(localStorage.getItem('ganesh_admin_last_order_id') || '0', 10);
        let pollReady = false;
        let soundEnabled = localStorage.getItem('ganesh_order_sound') !== 'off';
        const alertBar = document.getElementById('orderAlertBar');
        const alertText = document.getElementById('orderAlertText');
        const toastStack = document.getElementById('orderToastStack');
        const sidebarBadge = document.getElementById('sidebarPendingBadge');
        const mobileBadge = document.getElementById('mobilePendingBadge');
        const soundBtn = document.getElementById('orderSoundToggle');

        function updateSoundBtn(){
            if(!soundBtn) return;
            soundBtn.innerHTML = soundEnabled ? '<i class="bi bi-volume-up-fill"></i>' : '<i class="bi bi-volume-mute-fill"></i>';
        }
        updateSoundBtn();
        soundBtn?.addEventListener('click', function(){
            soundEnabled = !soundEnabled;
            localStorage.setItem('ganesh_order_sound', soundEnabled ? 'on' : 'off');
            updateSoundBtn();
            if(soundEnabled && 'speechSynthesis' in window){
                speak('Order voice alerts are now ON');
            }
        });

        function speak(text){
            if(!soundEnabled || !('speechSynthesis' in window)) return;
            window.speechSynthesis.cancel();
            const u = new SpeechSynthesisUtterance(text);
            u.rate = 0.92;
            u.pitch = 1.05;
            u.volume = 1;
            const voices = window.speechSynthesis.getVoices();
            const en = voices.find(v => v.lang.startsWith('en') && v.name.includes('Female')) || voices.find(v => v.lang.startsWith('en'));
            if(en) u.voice = en;
            window.speechSynthesis.speak(u);
        }

        function playBeep(){
            try {
                const ctx = new (window.AudioContext || window.webkitAudioContext)();
                [0, 0.25].forEach(function(delay){
                    const o = ctx.createOscillator();
                    const g = ctx.createGain();
                    o.connect(g); g.connect(ctx.destination);
                    o.frequency.value = delay ? 880 : 660;
                    g.gain.value = 0.15;
                    o.start(ctx.currentTime + delay);
                    o.stop(ctx.currentTime + delay + 0.2);
                });
            } catch(e){}
        }

        function showToast(order){
            const el = document.createElement('div');
            el.className = 'alert alert-warning shadow-lg border-0 mb-2';
            el.innerHTML = '<strong><i class="bi bi-bag-plus"></i> New Order!</strong><br>'+
                order.order_no+' · '+order.customer_name+'<br>'+
                '<span class="small">₹'+order.total+' · '+order.phone+'</span>'+
                ' <a href="'+ordersUrl+'" class="alert-link small">Open</a>';
            toastStack.prepend(el);
            setTimeout(function(){ el.remove(); }, 12000);
        }

        function announceOrder(order){
            alertText.textContent = '🔔 New order '+order.order_no+' from '+order.customer_name+' — ₹'+order.total;
            alertBar.classList.add('show');
            showToast(order);
            playBeep();
            speak('Attention! One new order is coming. Order number '+order.order_no+' from '+order.customer_name+'. Total amount '+order.total+' rupees. Please check the orders panel.');
            if(Notification.permission === 'granted'){
                new Notification('Ganesh Restaurant — New Order', {
                    body: order.order_no+' · '+order.customer_name+' · ₹'+order.total,
                    icon: @json(asset('images/logo-icon.png'))
                });
            }
        }

        function setPendingCount(n){
            [sidebarBadge, mobileBadge].forEach(function(b){
                if(!b) return;
                if(n > 0){ b.textContent = n; b.classList.remove('d-none'); }
                else { b.classList.add('d-none'); }
            });
        }

        document.getElementById('orderAlertDismiss')?.addEventListener('click', function(){
            alertBar.classList.remove('show');
        });

        if('Notification' in window && Notification.permission === 'default'){
            Notification.requestPermission();
        }

        async function pollOrders(){
            try {
                const res = await fetch(pollUrl+'?after='+lastSeenId, { headers:{'Accept':'application/json'} });
                if(!res.ok) return;
                const data = await res.json();
                setPendingCount(data.pending_count || 0);

                if(!pollReady){
                    lastSeenId = data.latest_id || lastSeenId;
                    pollReady = true;
                    localStorage.setItem('ganesh_admin_last_order_id', String(lastSeenId));
                    return;
                }

                const orders = (data.orders || []).slice().reverse();
                orders.forEach(function(order){
                    if(order.id > lastSeenId){
                        announceOrder(order);
                        lastSeenId = order.id;
                    }
                });
                if(data.latest_id > lastSeenId) lastSeenId = data.latest_id;
                localStorage.setItem('ganesh_admin_last_order_id', String(lastSeenId));
            } catch(e){}
        }

        pollOrders();
        setInterval(pollOrders, 8000);
    })();
    </script>
    @stack('scripts')
</body>
</html>
