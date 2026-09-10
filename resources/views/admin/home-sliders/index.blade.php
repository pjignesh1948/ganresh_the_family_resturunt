@extends('layouts.admin')

@section('title', 'Home Sliders')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0"><i class="bi bi-images me-2" style="color: #818cf8;"></i>Home Sliders</h1>
    <a href="{{ route('admin.home-sliders.create') }}" class="btn btn-accent"><i class="bi bi-plus-lg"></i> Add Slider</a>
</div>
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0 admin-datatable">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Link</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sliders as $slider)
                    <tr>
                        <td>
                            @if($slider->image)
                                <img src="{{ asset('storage/'.$slider->image) }}" alt="{{ $slider->title }}" height="48" class="rounded" style="object-fit: cover; width: 80px;">
                            @else
                                —
                            @endif
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $slider->title ?? '—' }}</div>
                            @if($slider->subtitle)<div class="small text-muted">{{ Str::limit($slider->subtitle, 50) }}</div>@endif
                        </td>
                        <td>
                            @if($slider->link)
                                <a href="{{ $slider->link }}" target="_blank" class="text-decoration-none" style="color: #818cf8;">{{ Str::limit($slider->link, 30) }}</a>
                            @else
                                —
                            @endif
                        </td>
                        <td>{{ $slider->sort_order }}</td>
                        <td><span class="badge bg-{{ $slider->is_active ? 'success' : 'secondary' }}">{{ $slider->is_active ? 'Active' : 'Inactive' }}</span></td>
                        <td>
                            <a href="{{ route('admin.home-sliders.edit', $slider) }}" class="btn btn-sm btn-outline-accent"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.home-sliders.destroy', $slider) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this slider?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">No sliders found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
