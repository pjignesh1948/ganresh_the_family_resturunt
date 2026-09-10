@extends('layouts.admin')

@section('title', $sop->title)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">{{ $sop->title }}</h1>
    <a href="{{ route('admin.sops.edit', $sop) }}" class="btn btn-maroon">Edit</a>
</div>
<div class="card shadow-sm"><div class="card-body">
    <p><strong>Category:</strong> {{ $sop->category ?? '—' }} | <strong>Version:</strong> {{ $sop->version }} | <strong>Status:</strong> {{ $sop->is_active ? 'Active' : 'Inactive' }}</p>
    @if($sop->document)<p><a href="{{ asset('storage/'.$sop->document) }}" class="btn btn-sm btn-outline-primary" target="_blank"><i class="bi bi-file-earmark"></i> Download Document</a></p>@endif
    @if($sop->content)<div class="mt-3">{!! nl2br(e($sop->content)) !!}</div>@else<p class="text-muted">No content.</p>@endif
</div></div>
<a href="{{ route('admin.sops.index') }}" class="btn btn-outline-secondary mt-3">Back</a>
@endsection
