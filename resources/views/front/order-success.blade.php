@extends('layouts.front')

@section('title', 'Order Confirmed — Ganesh The Family Restaurant')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 text-center">
                <div class="display-1 text-success mb-3"><i class="bi bi-check-circle-fill"></i></div>
                <h1 class="brand-font text-primary-custom">Thank You!</h1>
                <p class="lead">Your order has been placed successfully.</p>
                <div class="card shadow-sm border-0 bg-gold-light p-4 my-4 text-start">
                    <p class="mb-1"><strong>Order Number:</strong> {{ $order->order_no }}</p>
                    <p class="mb-1"><strong>Total:</strong> ₹{{ number_format($order->total_amount, 2) }}</p>
                    <p class="mb-1"><strong>Phone:</strong> {{ $order->phone }}</p>
                    <hr>
                    <p class="mb-2 fw-semibold"><i class="bi bi-bell"></i> What happens next?</p>
                    <ul class="small text-muted mb-0 ps-3">
                        <li>Our kitchen team has been <strong>notified instantly</strong> (voice alert + admin panel).</li>
                        @php $n = session('order_notifications', []); @endphp
                        @if(!empty($n['sms_customer']))
                            <li>Confirmation SMS sent to your mobile.</li>
                        @elseif(!empty($n['sms_configured']))
                            <li>SMS confirmation will be sent when SMS is active.</li>
                        @else
                            <li>We will <strong>call you shortly</strong> on {{ $order->phone }} to confirm.</li>
                        @endif
                        @if(!empty($n['email']))
                            <li>Restaurant team received email notification.</li>
                        @endif
                    </ul>
                </div>
                <a href="{{ route('front.order') }}" class="btn btn-primary-custom me-2">Order More</a>
                <a href="{{ route('front.home') }}" class="btn btn-outline-secondary">Back to Home</a>
            </div>
        </div>
    </div>
</section>
@endsection
