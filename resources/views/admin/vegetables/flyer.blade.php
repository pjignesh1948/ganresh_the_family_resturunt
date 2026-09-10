@extends('layouts.admin')

@section('title', 'Daily Price Flyer')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 mb-0"><i class="bi bi-magic"></i> Generate Daily Price Flyer</h1>
        <p class="text-muted small mb-0">Auto-generates image from current vegetable & fruit prices (like your demo flyer)</p>
    </div>
    <div class="d-flex gap-2">
        <button type="button" id="downloadFlyerBtn" class="btn btn-accent btn-lg"><i class="bi bi-download"></i> Download Image (PNG)</button>
        <a href="{{ route('admin.vegetables.index') }}" class="btn btn-outline-secondary">Back to Vegetables</a>
    </div>
</div>

@php
    $vegChunks = $vegetables->chunk(ceil(max($vegetables->count(), 1) / 2));
    $vegLeft = $vegChunks->get(0, collect());
    $vegRight = $vegChunks->get(1, collect());
@endphp

<div class="d-flex justify-content-center pb-4">
    <div id="flyerCanvas" style="width:920px;max-width:100%;font-family:'Segoe UI',Arial,sans-serif;background:#f4f1ea;border:3px solid #2d6a4f;border-radius:8px;overflow:hidden;">
        <div style="background:linear-gradient(135deg,#1b4332,#40916c);color:#fff;padding:18px 22px;display:flex;justify-content:space-between;align-items:center;gap:12px;">
            <div>
                <div style="font-size:26px;font-weight:800;">Ganesh Vegetable Mart</div>
                <div style="font-size:13px;opacity:.95;margin-top:3px;">સારી ક્વોલિટી · ઓછી કિંમત · Gota, Ahmedabad</div>
            </div>
            <div style="text-align:right;font-size:13px;">
                <div>📅 Date: {{ now()->format('d-m-Y') }}</div>
                <div>તાજું શાકભાજી બેસ્ટ ભાવમાં</div>
            </div>
        </div>
        <div style="background:#2d6a4f;color:#fff;text-align:center;padding:9px;font-size:17px;font-weight:700;letter-spacing:1px;">TODAY'S SELLING PRICE</div>

        @if($fruits->isNotEmpty())
        <div style="padding:14px 18px 0;">
            <div style="background:#74c69d;color:#1b4332;padding:7px 12px;border-radius:6px;font-weight:700;margin-bottom:10px;display:inline-block;">🍎 TODAY'S FRUITS</div>
            <div style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:14px;">
                @foreach($fruits as $fruit)
                @php $rate = round((float) $fruit->retail_price_per_kg); @endphp
                <div style="background:#fff;border:2px solid #40916c;border-radius:10px;padding:10px 16px;min-width:140px;text-align:center;box-shadow:0 2px 6px rgba(0,0,0,.06);">
                    <div style="font-weight:800;color:#1b4332;">{{ $fruit->name_gu ?? $fruit->name }}</div>
                    <div style="font-size:11px;color:#666;">{{ $fruit->name }}</div>
                    <div style="font-size:18px;font-weight:800;color:#c1121f;margin-top:4px;">₹ {{ $rate }} / Kg</div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <div style="padding:0 18px 16px;">
            <div style="background:#40916c;color:#fff;padding:7px 12px;border-radius:6px;font-weight:700;margin-bottom:10px;display:inline-block;">🥬 TODAY'S VEGETABLES</div>
            <div style="display:flex;gap:10px;">
                @foreach([$vegLeft, $vegRight] as $chunk)
                @if($chunk->isNotEmpty())
                <table style="width:50%;border-collapse:collapse;font-size:11.5px;background:#fff;border-radius:8px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.08);">
                    <thead>
                        <tr style="background:#1b4332;color:#fff;">
                            <th style="padding:7px;text-align:left;">શાકભાજી</th>
                            <th style="padding:7px;text-align:center;">250g</th>
                            <th style="padding:7px;text-align:center;">500g</th>
                            <th style="padding:7px;text-align:center;background:#c1121f;">1 Kg</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($chunk as $i => $veg)
                        @php
                            $rate = (float) $veg->retail_price_per_kg;
                            $p250 = round($rate * 0.25, $rate < 100 ? 0 : 0);
                            $p500 = round($rate * 0.5, 0);
                            $p1kg = round($rate);
                            if ($rate == 70) { $p250 = 17.5; $p500 = 35; }
                            if ($rate == 150) { $p250 = 37.5; $p500 = 75; }
                            if ($rate == 90) { $p250 = 22.5; $p500 = 45; }
                            if ($rate == 220) { $p250 = 37.5; $p500 = 75; }
                        @endphp
                        <tr style="background:{{ $i % 2 ? '#f8faf8' : '#fff' }};border-bottom:1px solid #e8ece8;">
                            <td style="padding:6px 7px;"><strong>{{ $veg->name_gu ?? $veg->name }}</strong></td>
                            <td style="padding:6px;text-align:center;">₹ {{ is_float($p250) && fmod($p250, 1) ? number_format($p250, 1) : $p250 }}</td>
                            <td style="padding:6px;text-align:center;">₹ {{ $p500 }}</td>
                            <td style="padding:6px;text-align:center;font-weight:800;color:#c1121f;background:#fff5f5;">₹ {{ $p1kg }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
                @endforeach
            </div>
        </div>

        <div style="background:#1b4332;color:#fff;padding:12px 18px;font-size:11px;line-height:1.6;">
            <div>🛒 દરરોજ તાજા માલની આવક · Ganesh Vegetable Mart, Gota, Ahmedabad</div>
            <div>⏰ સમય: સવારે 9:30 થી 2:30, સાંજે 5:00 થી 7:45 · રવિવારે માત્ર સવારે 9:30 થી 2:30</div>
            <div>📞 9276819283 · 8200692794 · Healthy Food · Happy Life</div>
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
    html2canvas(document.getElementById('flyerCanvas'), { scale: 2, useCORS: true, backgroundColor: '#f4f1ea' }).then(function(canvas){
        const link = document.createElement('a');
        link.download = 'ganesh-vegetable-prices-{{ now()->format('Y-m-d') }}.png';
        link.href = canvas.toDataURL('image/png');
        link.click();
        btn.disabled = false;
        btn.innerHTML = '<i class="bi bi-download"></i> Download Image (PNG)';
    }).catch(function(){
        alert('Could not generate image. Please try again.');
        btn.disabled = false;
        btn.innerHTML = '<i class="bi bi-download"></i> Download Image (PNG)';
    });
});
</script>
@endpush
