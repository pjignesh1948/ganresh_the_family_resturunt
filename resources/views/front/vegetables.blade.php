@extends('layouts.front')

@section('title', 'Vegetable Calculator — Ganesh The Family Restaurant')

@push('styles')
<style>
.veg-item { border:2px solid transparent!important; transition:all .2s; }
.veg-item.active { background:#fff!important; border-color:var(--primary)!important; box-shadow:0 4px 12px rgba(198,40,40,.12); }
.veg-item:hover { border-color:#ffcdd2!important; }
.preset-btn.active { background:var(--primary); color:#fff; border-color:var(--primary); }
#selectedPreview img { width:72px;height:72px;object-fit:cover;border-radius:12px;border:2px solid var(--gold); }
.veg-step { width:28px;height:28px;border-radius:50%;background:var(--primary);color:#fff;display:inline-flex;align-items:center;justify-content:center;font-size:.8rem;font-weight:700; }
@@media(min-width:992px){ .veg-bill-sticky { position:sticky; top:90px; } }
</style>
@endpush

@section('content')
<section class="py-4 bg-gold-light">
    <div class="container">
        <h1 class="section-title brand-font"><i class="bi bi-calculator-fill"></i> Vegetable Price Calculator</h1>
        <p class="text-muted mb-0">Easy 3-step: <strong>Pick vegetable → Set weight → Add to bill</strong> · Search in English, Hindi, Gujarati</p>
    </div>
</section>

<section class="py-4 pb-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-2 mb-3"><span class="veg-step">1</span><span class="fw-semibold">Choose Vegetable</span></div>
                        <input type="text" id="vegSearch" class="form-control form-control-lg mb-2" placeholder="🔍 tomato · टमाटर · ટામેટા">
                        <div id="vegList" class="veg-list mb-3" style="max-height:240px;overflow-y:auto;">
                            @foreach($vegetables as $veg)
                            <button type="button" class="veg-item btn btn-light w-100 text-start mb-2 p-2 {{ $loop->first ? 'active border-primary' : '' }}"
                                data-id="{{ $veg->id }}"
                                data-name="{{ $veg->name }}"
                                data-search="{{ $veg->searchBlob() }}"
                                data-retail="{{ $veg->retail_price_per_kg }}"
                                data-vendor="{{ $veg->vendor_price_per_kg ?? $veg->retail_price_per_kg }}"
                                data-desc="{{ $veg->description ?? '' }}"
                                data-desc-hi="{{ $veg->description_hi ?? '' }}"
                                data-desc-gu="{{ $veg->description_gu ?? '' }}"
                                data-name-hi="{{ $veg->name_hi ?? '' }}"
                                data-name-gu="{{ $veg->name_gu ?? '' }}"
                                data-img="{{ $veg->image ? \App\Providers\AppServiceProvider::mediaUrl($veg->image) : '' }}">
                                <div class="d-flex align-items-center gap-2">
                                    @if($veg->image)
                                        <img src="{{ \App\Providers\AppServiceProvider::mediaUrl($veg->image) }}" width="44" height="44" class="rounded object-fit-cover" alt="">
                                    @else
                                        <span class="veg-icon rounded d-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success" style="width:44px;height:44px"><i class="bi bi-flower1"></i></span>
                                    @endif
                                    <div class="flex-grow-1">
                                        <strong>{{ $veg->name }}</strong>
                                        @if($veg->name_hi || $veg->name_gu)
                                        <div class="small text-muted">{{ $veg->name_hi }}@if($veg->name_hi && $veg->name_gu) · @endif{{ $veg->name_gu }}</div>
                                        @endif
                                        <div class="small text-primary-custom">₹{{ number_format($veg->retail_price_per_kg,0) }}/kg retail</div>
                                    </div>
                                </div>
                            </button>
                            @endforeach
                        </div>

                        <div id="selectedVegInfo" class="d-flex gap-3 align-items-start p-3 rounded bg-gold-light border mb-3">
                            <div id="selectedPreview"><img src="" alt="" class="d-none" id="selectedImg"></div>
                            <div id="selectedText" class="small flex-grow-1"></div>
                        </div>

                        <div class="d-flex align-items-center gap-2 mb-2 mt-4"><span class="veg-step">2</span><span class="fw-semibold">Weight & Price Type</span></div>
                        <label class="form-label small text-muted">Quick weights</label>
                        <div class="d-flex flex-wrap gap-2 mb-3" id="weightPresets">
                            @foreach($weightPresets as $g)
                            <button type="button" class="btn btn-sm btn-outline-secondary preset-btn" data-grams="{{ $g }}">{{ $g >= 1000 ? '1 kg' : $g.'g' }}</button>
                            @endforeach
                        </div>

                        <label class="form-label small text-muted">Or type grams</label>
                        <input type="number" id="gramsInput" class="form-control form-control-lg mb-3" min="1" value="500">

                        <div class="btn-group w-100 mb-3">
                            <input type="radio" class="btn-check" name="priceType" id="ptRetail" value="retail" checked>
                            <label class="btn btn-outline-danger" for="ptRetail"><i class="bi bi-shop"></i> Retail</label>
                            <input type="radio" class="btn-check" name="priceType" id="ptVendor" value="vendor">
                            <label class="btn btn-outline-danger" for="ptVendor"><i class="bi bi-building"></i> Vendor</label>
                        </div>

                        <div id="liveResult" class="p-3 rounded text-center bg-primary-soft mb-3">
                            <div class="small text-muted">Price for selected weight</div>
                            <div class="display-6 fw-bold text-primary-custom mb-0" id="liveTotal">₹0.00</div>
                        </div>

                        <div class="d-flex align-items-center gap-2 mb-2"><span class="veg-step">3</span><span class="fw-semibold">Add to Bill</span></div>
                        <button type="button" id="addToBillBtn" class="btn btn-primary-custom btn-lg w-100"><i class="bi bi-plus-circle"></i> Add to Bill</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 veg-bill-sticky">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white fw-semibold d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-receipt"></i> Today's Bill</span>
                        <span class="fw-bold text-primary-custom" id="billGrandTotal">₹0.00</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="table-light"><tr><th>Item</th><th>Weight</th><th>Type</th><th>Price</th><th></th></tr></thead>
                                <tbody id="billBody"><tr id="emptyBill"><td colspan="5" class="text-center text-muted py-4">No items added yet</td></tr></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <button type="button" id="saveBillBtn" class="btn btn-gold w-100" disabled><i class="bi bi-save"></i> Save Sale to Database</button>
                        <div id="saveMsg" class="small text-success mt-2 text-center d-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    let selected = document.querySelector('.veg-item.active') || document.querySelector('.veg-item');
    const bill = [];
    const csrf = '{{ csrf_token() }}';

    function selectVeg(btn){
        document.querySelectorAll('.veg-item').forEach(b=>b.classList.remove('active','border-primary'));
        btn.classList.add('active','border-primary');
        selected = btn;
        const info = document.getElementById('selectedText');
        const imgEl = document.getElementById('selectedImg');
        let langLine = '<strong class="fs-6">'+btn.dataset.name+'</strong>';
        if(btn.dataset.nameHi || btn.dataset.nameGu) langLine += '<div class="text-muted">'+[btn.dataset.nameHi, btn.dataset.nameGu].filter(Boolean).join(' · ')+'</div>';
        langLine += '<div class="mt-1">Retail <b>₹'+btn.dataset.retail+'</b>/kg · Vendor <b>₹'+btn.dataset.vendor+'</b>/kg</div>';
        info.innerHTML = langLine;
        if(btn.dataset.img){ imgEl.src=btn.dataset.img; imgEl.classList.remove('d-none'); } else imgEl.classList.add('d-none');
        calcLive();
    }

    function getGrams(){ return parseFloat(document.getElementById('gramsInput').value) || 0; }
    function getType(){ return document.querySelector('input[name="priceType"]:checked').value; }
    function calcPrice(grams, rate){ return Math.round((grams/1000)*rate*100)/100; }

    function calcLive(){
        if(!selected) return;
        const rate = getType()==='vendor' ? parseFloat(selected.dataset.vendor) : parseFloat(selected.dataset.retail);
        document.getElementById('liveTotal').textContent = '₹'+calcPrice(getGrams(), rate).toFixed(2);
    }

    document.querySelectorAll('.veg-item').forEach(b=>b.addEventListener('click', ()=>selectVeg(b)));
    document.getElementById('vegSearch').addEventListener('input', function(){
        const q = this.value.toLowerCase().trim();
        document.querySelectorAll('.veg-item').forEach(b=>{
            b.style.display = !q || (b.dataset.search || '').includes(q) ? '' : 'none';
        });
    });
    document.querySelectorAll('.preset-btn').forEach(b=>b.addEventListener('click', function(){
        document.getElementById('gramsInput').value = this.dataset.grams;
        document.querySelectorAll('.preset-btn').forEach(x=>x.classList.remove('active','btn-primary-custom'));
        this.classList.add('active');
        calcLive();
    }));
    const defaultPreset = document.querySelector('.preset-btn[data-grams="500"]');
    if(defaultPreset) defaultPreset.classList.add('active');
    document.getElementById('gramsInput').addEventListener('input', calcLive);
    document.querySelectorAll('input[name="priceType"]').forEach(r=>r.addEventListener('change', calcLive));

    if(selected) selectVeg(selected);

    document.getElementById('addToBillBtn').addEventListener('click', function(){
        const grams = getGrams();
        if(!selected || grams<1) return alert('Select vegetable and weight');
        const type = getType();
        const rate = type==='vendor' ? parseFloat(selected.dataset.vendor) : parseFloat(selected.dataset.retail);
        const total = calcPrice(grams, rate);
        bill.push({ vegetable_id: selected.dataset.id, name: selected.dataset.name, grams, price_type: type, total });
        renderBill();
    });

    function renderBill(){
        const body = document.getElementById('billBody');
        if(!bill.length){
            body.innerHTML = '<tr id="emptyBill"><td colspan="5" class="text-center text-muted py-4">No items added yet</td></tr>';
            document.getElementById('billGrandTotal').textContent = '₹0.00';
            document.getElementById('saveBillBtn').disabled = true;
            return;
        }
        let grand = 0;
        body.innerHTML = bill.map((row,i)=>{
            grand += row.total;
            return '<tr><td>'+row.name+'</td><td>'+row.grams+'g</td><td>'+row.price_type+'</td><td>₹'+row.total.toFixed(2)+'</td><td><button type="button" class="btn btn-sm btn-outline-danger rm" data-i="'+i+'">&times;</button></td></tr>';
        }).join('');
        document.getElementById('billGrandTotal').textContent = '₹'+grand.toFixed(2);
        document.getElementById('saveBillBtn').disabled = false;
        body.querySelectorAll('.rm').forEach(btn=>btn.addEventListener('click', function(){
            bill.splice(parseInt(this.dataset.i),1); renderBill();
        }));
    }

    document.getElementById('saveBillBtn').addEventListener('click', function(){
        fetch('{{ route('front.vegetables.save') }}', {
            method:'POST',
            headers:{'Content-Type':'application/json','X-CSRF-TOKEN':csrf,'Accept':'application/json'},
            body: JSON.stringify({ items: bill.map(r=>({ vegetable_id:r.vegetable_id, grams:r.grams, price_type:r.price_type })) })
        }).then(r=>r.json()).then(data=>{
            if(data.success){
                document.getElementById('saveMsg').textContent = 'Saved! Total '+data.formatted;
                document.getElementById('saveMsg').classList.remove('d-none');
                bill.length=0; renderBill();
            }
        }).catch(()=>alert('Could not save. Try again.'));
    });
});
</script>
@endpush
