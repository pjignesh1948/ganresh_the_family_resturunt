@extends('layouts.front')

@section('title', 'Contact Us — Ganesh The Family Restaurant')

@section('content')
@php $site = \App\Models\SiteSetting::class; @endphp
<section class="py-5">
    <div class="container">
        <h1 class="section-title mb-4">Contact Us</h1>
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h5 class="text-maroon mb-3">Get in Touch</h5>
                        @if($site::get('phone'))
                            <p class="mb-2"><i class="bi bi-telephone text-maroon me-2"></i>{{ $site::get('phone') }}</p>
                        @endif
                        @if($site::get('email'))
                            <p class="mb-2"><i class="bi bi-envelope text-maroon me-2"></i><a href="mailto:{{ $site::get('email') }}">{{ $site::get('email') }}</a></p>
                        @endif
                        @if($site::get('address'))
                            <p class="mb-2"><i class="bi bi-geo-alt text-maroon me-2"></i>{{ $site::get('address') }}</p>
                        @endif
                        @if($site::get('opening_hours'))
                            <p class="mb-2"><i class="bi bi-clock text-maroon me-2"></i>{{ $site::get('opening_hours') }}</p>
                        @endif
                        @if($site::get('whatsapp_number'))
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $site::get('whatsapp_number')) }}" class="btn btn-success mt-2" target="_blank">
                                <i class="bi bi-whatsapp me-1"></i> WhatsApp
                            </a>
                        @endif
                        @if($site::get('google_maps_embed'))
                            <div class="mt-4 ratio ratio-4x3">
                                {!! $site::get('google_maps_embed') !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="text-maroon mb-3">Send a Message</h5>
                        <form action="{{ route('front.contact.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Name *</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Subject</label>
                                    <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject') }}">
                                    @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Message *</label>
                                    <textarea name="message" class="form-control @error('message') is-invalid @enderror" rows="5" required>{{ old('message') }}</textarea>
                                    @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-maroon">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
