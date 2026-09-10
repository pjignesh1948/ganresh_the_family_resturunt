@extends('layouts.front')

@section('title', 'Order Online — Ganesh The Family Restaurant')

@push('styles')
<style>
.order-layout { min-height: 60vh; }
.category-sidebar { position: sticky; top: 80px; max-height: calc(100vh - 100px); overflow-y: auto; }
.category-pill { display:block; width:100%; text-align:left; border:none; background:#fff; padding:.75rem 1rem; margin-bottom:.5rem; border-radius:10px; box-shadow:0 2px 8px rgba(0,0,0,.06); transition:all .2s; border-left:4px solid transparent; }
.category-pill:hover, .category-pill.active { border-left-color:var(--primary); background:var(--primary-soft); color:var(--primary); font-weight:600; }
.category-pill .count { float:right; opacity:.6; font-size:.8rem; }
.menu-item-card.hidden { display:none !important; }
.category-block.hidden { display:none !important; }
.search-highlight { box-shadow: 0 0 0 2px var(--gold); }
</style>
@endpush

@section('content')
<section class="py-4 bg-gold-light">
    <div class="container">
        <h1 class="section-title brand-font"><i class="bi bi-bag-check-fill"></i> Order Online</h1>
        <p class="text-muted mb-0">Select category · Search dish · Add to cart · Checkout</p>
    </div>
</section>

<section class="py-4 pb-5 mb-5 order-layout">
    <div class="container">
        <div class="mb-4">
            <input type="search" id="menuSearch" class="form-control form-control-lg" placeholder="🔍 Search any dish — Paper Dosa, Paneer, Biryani...">
        </div>

        <div class="row g-4">
            <div class="col-lg-3">
                <div class="category-sidebar">
                    <h6 class="text-muted text-uppercase small mb-3"><i class="bi bi-grid"></i> Categories</h6>
                    @php $firstCat = true; @endphp
                    @foreach($categories as $category)
                        @if($category->menuItems->isNotEmpty())
                        <button type="button" class="category-pill {{ $firstCat ? 'active' : '' }}" data-target="cat-{{ $category->id }}">
                            {{ $category->name }}
                            <span class="count">{{ $category->menuItems->count() }}</span>
                        </button>
                        @php $firstCat = false; @endphp
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="col-lg-9">
                @php $firstBlock = true; @endphp
                @forelse($categories as $category)
                    @if($category->menuItems->isNotEmpty())
                    <div class="category-block mb-4 {{ $firstBlock ? '' : 'hidden' }}" id="cat-{{ $category->id }}" data-category="{{ $category->name }}">
                        <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                            @if($category->image)
                            <img src="{{ \App\Providers\AppServiceProvider::mediaUrl($category->image) }}" width="48" height="48" class="rounded object-fit-cover" alt="" onerror="this.style.display='none'">
                            @endif
                            <div>
                                <h4 class="mb-0 brand-font text-primary-custom">{{ $category->name }}</h4>
                                <small class="text-muted">{{ $category->menuItems->count() }} items available</small>
                            </div>
                        </div>
                        <div class="row g-3">
                            @foreach($category->menuItems as $item)
                            <div class="col-6 col-md-4 col-xl-3 menu-item-card" data-name="{{ strtolower($item->name) }}" data-category="{{ strtolower($category->name) }}">
                                <div class="card card-menu h-100 shadow-sm border-0 overflow-hidden">
                                    <div class="menu-img-wrap">
                                        <img src="{{ \App\Providers\AppServiceProvider::mediaUrl($item->image) }}" class="card-img-top" alt="{{ $item->name }}" style="height:130px;object-fit:cover" loading="lazy" onerror="this.onerror=null;this.src='{{ asset('images/logo-icon.png') }}';">
                                        <div class="menu-hover-overlay"><span class="text-white small fw-semibold"><i class="bi bi-plus-circle"></i> Add</span></div>
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="d-flex justify-content-between align-items-start mb-1">
                                            <span class="badge bg-success"><i class="bi bi-leaf"></i></span>
                                            <span class="fw-bold text-primary-custom fs-5">₹{{ number_format($item->price, 0) }}</span>
                                        </div>
                                        <h6 class="fw-semibold item-title mb-2 lh-sm">{{ $item->name }}</h6>
                                        <div class="d-flex align-items-center justify-content-between mt-auto pt-1">
                                            <button type="button" class="btn btn-sm btn-outline-secondary qty-minus" data-id="{{ $item->id }}">−</button>
                                            <span class="fw-bold qty-display" data-id="{{ $item->id }}">0</span>
                                            <button type="button" class="btn btn-sm btn-primary-custom qty-plus" data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-price="{{ $item->price }}">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @php $firstBlock = false; @endphp
                    @endif
                @empty
                    <div class="alert alert-info">Menu loading soon.</div>
                @endforelse
            </div>
        </div>
    </div>
</section>

<div class="cart-bar fixed-bottom py-3" id="cartBar" style="display:none;">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap">
            <div><i class="bi bi-cart3"></i> <strong id="cartCount">0 items</strong> · <span id="cartPreview" class="text-muted small"></span></div>
            <div class="d-flex align-items-center gap-3">
                <span class="fs-5 fw-bold text-primary-custom" id="cartTotalBar">₹0</span>
                <button type="button" class="btn btn-gold px-4" data-bs-toggle="modal" data-bs-target="#checkoutModal"><i class="bi bi-credit-card"></i> Checkout</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="checkoutModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <form action="{{ route('front.order.store') }}" method="POST" id="checkoutForm">
                @csrf
                <div class="modal-header bg-gold-light">
                    <h5 class="modal-title brand-font"><i class="bi bi-bag-check"></i> Checkout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="checkoutItems" class="mb-4"></div>
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label">Name *</label><input type="text" name="customer_name" class="form-control" required></div>
                        <div class="col-md-6"><label class="form-label">Phone *</label><input type="tel" name="phone" class="form-control" required></div>
                        <div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" class="form-control"></div>
                        <div class="col-12"><label class="form-label">Address</label><textarea name="address" class="form-control" rows="2"></textarea></div>
                        <div class="col-12"><label class="form-label">Notes</label><textarea name="notes" class="form-control" rows="2"></textarea></div>
                    </div>
                    <div id="hiddenItems"></div>
                    <div class="d-flex justify-content-between fw-bold fs-5 mt-4 pt-3 border-top">
                        <span>Total</span><span class="text-primary-custom" id="checkoutTotal">₹0</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Back</button>
                    <button type="submit" class="btn btn-primary-custom"><i class="bi bi-check2-circle"></i> Place Order</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    const cart = {};
    const cartBar = document.getElementById('cartBar');
    let searchMode = false;

    function showCategory(id){
        document.querySelectorAll('.category-block').forEach(b => b.classList.add('hidden'));
        document.getElementById(id)?.classList.remove('hidden');
        document.querySelectorAll('.category-pill').forEach(p => p.classList.toggle('active', p.dataset.target === id));
    }

    document.querySelectorAll('.category-pill').forEach(btn => {
        btn.addEventListener('click', function(){
            searchMode = false;
            document.getElementById('menuSearch').value = '';
            document.querySelectorAll('.menu-item-card').forEach(c => c.classList.remove('hidden'));
            showCategory(this.dataset.target);
        });
    });

    document.getElementById('menuSearch').addEventListener('input', function(){
        const q = this.value.toLowerCase().trim();
        searchMode = q.length > 0;
        if(!searchMode){
            document.querySelectorAll('.menu-item-card').forEach(c => c.classList.remove('hidden'));
            const active = document.querySelector('.category-pill.active');
            if(active) showCategory(active.dataset.target);
            return;
        }
        document.querySelectorAll('.category-block').forEach(b => b.classList.remove('hidden'));
        document.querySelectorAll('.menu-item-card').forEach(c => {
            const match = c.dataset.name.includes(q) || c.dataset.category.includes(q);
            c.classList.toggle('hidden', !match);
        });
        document.querySelectorAll('.category-block').forEach(block => {
            const visible = block.querySelectorAll('.menu-item-card:not(.hidden)').length > 0;
            block.classList.toggle('hidden', !visible);
        });
    });

    function renderCart(){
        const hidden = document.getElementById('hiddenItems');
        const checkoutItems = document.getElementById('checkoutItems');
        hidden.innerHTML = ''; checkoutItems.innerHTML = '';
        let total=0, count=0, idx=0, preview=[];
        Object.values(cart).forEach(item=>{
            if(item.qty<=0) return;
            const line = item.price*item.qty; total+=line; count+=item.qty;
            preview.push(item.name+' ×'+item.qty);
            hidden.innerHTML += '<input type="hidden" name="items['+idx+'][menu_item_id]" value="'+item.id+'"><input type="hidden" name="items['+idx+'][quantity]" value="'+item.qty+'">';
            checkoutItems.innerHTML += '<div class="d-flex justify-content-between border-bottom py-2"><span>'+item.name+' × '+item.qty+'</span><strong>₹'+(line.toFixed(2))+'</strong></div>';
            idx++;
        });
        document.querySelectorAll('.qty-display').forEach(el=>{ el.textContent = cart[el.dataset.id]?.qty||0; });
        document.getElementById('cartCount').textContent = count+' item'+(count!==1?'s':'');
        document.getElementById('cartPreview').textContent = preview.slice(0,2).join(', ');
        document.getElementById('cartTotalBar').textContent = '₹'+total.toFixed(2);
        document.getElementById('checkoutTotal').textContent = '₹'+total.toFixed(2);
        cartBar.style.display = count>0 ? 'block' : 'none';
    }

    document.querySelectorAll('.qty-plus').forEach(btn=>btn.addEventListener('click', function(){
        const id = this.dataset.id;
        if(!cart[id]) cart[id]={id, name:this.dataset.name, price:parseFloat(this.dataset.price), qty:0};
        cart[id].qty++; renderCart();
    }));
    document.querySelectorAll('.qty-minus').forEach(btn=>btn.addEventListener('click', function(){
        const id = this.dataset.id;
        if(cart[id]&&cart[id].qty>0){ cart[id].qty--; renderCart(); }
    }));
    renderCart();
});
</script>
@endpush
