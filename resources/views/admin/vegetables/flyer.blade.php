@extends('layouts.admin')

@section('title', 'Daily Price Flyer')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 mb-0"><i class="bi bi-magic"></i> Daily Price Flyer</h1>
        <p class="text-muted small mb-0">Only <strong>Active</strong> vegetables/fruits appear. Deactivate item to hide from flyer.</p>
    </div>
    <div class="d-flex gap-2">
        <button type="button" id="downloadFlyerBtn" class="btn btn-accent btn-lg"><i class="bi bi-download"></i> Download PNG</button>
        <a href="{{ route('admin.vegetables.index') }}" class="btn btn-outline-secondary">Back</a>
    </div>
</div>

@php
    $vegChunks = $vegetables->chunk(ceil(max($vegetables->count(), 1) / 2));
    $vegLeft = $vegChunks->get(0, collect());
    $vegRight = $vegChunks->get(1, collect());
@endphp

<div class="d-flex justify-content-center pb-4">
    <div id="flyerCanvas" style="width:900px;max-width:100%;background:#fff;border:2px solid #2d6a4f;font-family:Arial,sans-serif;color:#222;">

        <div style="padding:14px 16px;border-bottom:2px solid #2d6a4f;display:flex;justify-content:space-between;align-items:center;gap:10px;background:#f7f7f2;">
            <div style="display:flex;align-items:center;gap:10px;">
                <img src="{{ asset('images/logo-icon.png') }}" alt="Ganesh" style="width:70px;height:70px;border-radius:50%;object-fit:cover;">
                <div>
                    <div style="font-size:22px;font-weight:800;color:#1b4332;">Ganesh Vegetable Mart</div>
                    <div style="font-size:12px;color:#555;">સારી ક્વોલિટી · ઓછી કિંમત</div>
                </div>
            </div>
            <div style="text-align:center;flex:1;">
                <div style="font-size:24px;font-weight:900;color:#c1121f;">આજના શાકભાજીના ભાવ</div>
                <div style="margin-top:6px;display:inline-block;background:#2d6a4f;color:#fff;padding:4px 12px;border-radius:4px;font-size:13px;">Date - {{ now()->format('d/m/Y') }}</div>
            </div>
            <div style="font-size:12px;text-align:right;color:#444;max-width:170px;">ગોતામાં સસ્તા ભાવે શાકભાજી</div>
        </div>

        <div style="padding:12px 14px;">
            <div style="display:flex;gap:10px;">
                @foreach([$vegLeft, $vegRight] as $chunk)
                    @if($chunk->isNotEmpty())
                    <table style="width:50%;border-collapse:collapse;font-size:12px;border:1px solid #ccc;">
                        <thead>
                            <tr style="background:#2d6a4f;color:#fff;">
                                <th style="padding:6px;text-align:left;">શાકભાજી</th>
                                <th style="padding:6px;text-align:center;">250 gm</th>
                                <th style="padding:6px;text-align:center;">500 gm</th>
                                <th style="padding:6px;text-align:center;background:#c1121f;">1 Kg</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($chunk as $i => $veg)
                            @php
                                $rate = (float) $veg->retail_price_per_kg;
                                $p250 = round($rate * 0.25, $rate < 100 ? 1 : 0);
                                $p500 = round($rate * 0.5, 0);
                                $p1kg = round($rate, 0);
                            @endphp
                            <tr style="background:{{ $i % 2 ? '#fafafa' : '#fff' }};border-bottom:1px solid #eee;">
                                <td style="padding:5px;">
                                    <div style="display:flex;align-items:center;gap:6px;">
                                        <img src="@media($veg->image)" alt="" style="width:28px;height:28px;object-fit:cover;border-radius:4px;" crossorigin="anonymous">
                                        <span><strong>{{ $veg->name_gu ?? $veg->name }}</strong></span>
                                    </div>
                                </td>
                                <td style="padding:5px;text-align:center;">₹ {{ is_float($p250) && fmod($p250, 1) ? number_format($p250, 1) : $p250 }}</td>
                                <td style="padding:5px;text-align:center;">₹ {{ $p500 }}</td>
                                <td style="padding:5px;text-align:center;font-weight:800;color:#c1121f;">₹ {{ $p1kg }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                @endforeach
            </div>

            @if($fruits->isNotEmpty())
            <div style="margin-top:14px;border-top:2px solid #2d6a4f;padding-top:10px;">
                <div style="font-size:16px;font-weight:800;color:#c1121f;margin-bottom:8px;">ફળો / Fruits</div>
                <div style="display:flex;gap:10px;flex-wrap:wrap;">
                    @foreach($fruits as $fruit)
                    @php $rate = round((float) $fruit->retail_price_per_kg); @endphp
                    <div style="border:1px solid #ccc;border-radius:6px;padding:8px 12px;min-width:150px;text-align:center;background:#fff;">
                        <img src="@media($fruit->image)" alt="" style="width:36px;height:36px;object-fit:cover;border-radius:4px;" crossorigin="anonymous">
                        <div style="font-weight:700;margin-top:4px;">{{ $fruit->name_gu ?? $fruit->name }}</div>
                        <div style="color:#c1121f;font-weight:800;">₹ {{ $rate }} / Kg</div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <div style="background:#1b4332;color:#fff;padding:10px 14px;font-size:11px;line-height:1.5;">
            <div>📍 Ganesh Vegetable Mart, Gota, Ahmedabad · 📞 9276819283 / 8200692794</div>
            <div>🛒 દરરોજ તાજા માલ · ⏰ સવાર 9:30-2:30 · સાંજ 5:00-7:45</div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
document.getElementById('downloadFlyerBtn').addEventListener('click', function(){
    const btn = this;
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Generating...';
    html2canvas(document.getElementById('flyerCanvas'), { scale: 2, useCORS: true, backgroundColor: '#ffffff' }).then(function(canvas){
        const link = document.createElement('a');
        link.download = 'ganesh-vegetable-prices-{{ now()->format('Y-m-d') }}.png';
        link.href = canvas.toDataURL('image/png');
        link.click();
        btn.disabled = false;
        btn.innerHTML = '<i class="bi bi-download"></i> Download PNG';
    }).catch(function(){
        alert('Could not generate image. Please try again.');
        btn.disabled = false;
        btn.innerHTML = '<i class="bi bi-download"></i> Download PNG';
    });
});
</script>
@endpush
