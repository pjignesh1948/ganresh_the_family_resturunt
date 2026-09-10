@extends('layouts.admin')

@section('title', 'Site Settings')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Site Settings</h1>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Site Name</label>
                    <input type="text" name="site_name" class="form-control" value="{{ old('site_name', $settings['site_name'] ?? '') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tagline</label>
                    <input type="text" name="tagline" class="form-control" value="{{ old('tagline', $settings['tagline'] ?? '') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $settings['phone'] ?? '') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $settings['email'] ?? '') }}">
                </div>
                <div class="col-12">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control" rows="2">{{ old('address', $settings['address'] ?? '') }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Opening Hours</label>
                    <input type="text" name="opening_hours" class="form-control" value="{{ old('opening_hours', $settings['opening_hours'] ?? '') }}" placeholder="Mon-Sun: 10 AM - 10 PM">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Facebook URL</label>
                    <input type="url" name="facebook_url" class="form-control" value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Instagram URL</label>
                    <input type="url" name="instagram_url" class="form-control" value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">WhatsApp Number</label>
                    <input type="text" name="whatsapp_number" class="form-control" value="{{ old('whatsapp_number', $settings['whatsapp_number'] ?? '') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Order Notification Email</label>
                    <input type="email" name="order_notify_email" class="form-control" value="{{ old('order_notify_email', $settings['order_notify_email'] ?? '') }}">
                </div>
                <div class="col-12">
                    <label class="form-label">Google Maps Embed (iframe HTML)</label>
                    <textarea name="google_maps_embed" class="form-control" rows="3">{{ old('google_maps_embed', $settings['google_maps_embed'] ?? '') }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Logo</label>
                    @if(!empty($settings['logo']))
                        <div class="mb-2"><img src="{{ asset('storage/'.$settings['logo']) }}" alt="Logo" height="60"></div>
                    @endif
                    <input type="file" name="logo" class="form-control" accept="image/*">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Favicon</label>
                    @if(!empty($settings['favicon']))
                        <div class="mb-2"><img src="{{ asset('storage/'.$settings['favicon']) }}" alt="Favicon" height="32"></div>
                    @endif
                    <input type="file" name="favicon" class="form-control" accept="image/*">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-maroon">Save Settings</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
