@extends('layouts.admin')

@section('title', 'Promotions')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0"><i class="bi bi-megaphone me-2" style="color: #818cf8;"></i>Promotions</h1>
    <a href="{{ route('admin.promotions.create') }}" class="btn btn-accent"><i class="bi bi-plus-lg"></i> Add Promotion</a>
</div>
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0 admin-datatable">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Link</th>
                    <th>Show Once</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($promotions as $promotion)
                    <tr>
                        <td>
                            @if($promotion->image)
                                <img src="{{ asset('storage/'.$promotion->image) }}" alt="{{ $promotion->title }}" height="48" class="rounded" style="object-fit: cover; width: 80px;">
                            @else
                                —
                            @endif
                        </td>
                        <td class="fw-semibold">{{ $promotion->title ?? '—' }}</td>
                        <td>
                            @if($promotion->link)
                                <a href="{{ $promotion->link }}" target="_blank" class="text-decoration-none" style="color: #818cf8;">{{ Str::limit($promotion->link, 30) }}</a>
                            @else
                                —
                            @endif
                        </td>
                        <td><span class="badge bg-{{ $promotion->show_once ? 'secondary' : 'warning' }}">{{ $promotion->show_once ? 'Once' : 'Always' }}</span></td>
                        <td><span class="badge bg-{{ $promotion->is_active ? 'success' : 'secondary' }}">{{ $promotion->is_active ? 'Active' : 'Inactive' }}</span></td>
                        <td>
                            <a href="{{ route('admin.promotions.edit', $promotion) }}" class="btn btn-sm btn-outline-accent"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.promotions.destroy', $promotion) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this promotion?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">No promotions found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
