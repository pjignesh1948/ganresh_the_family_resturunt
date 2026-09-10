@extends('layouts.admin')

@section('title', $portfolio->title)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">{{ $portfolio->title }}</h1>
    <a href="{{ route('admin.portfolios.edit', $portfolio) }}" class="btn btn-maroon">Edit</a>
</div>
<div class="row"><div class="col-md-6">
@if($portfolio->image)<img src="{{ asset('storage/'.$portfolio->image) }}" class="img-fluid rounded shadow-sm mb-3">@endif
<p><strong>Event Date:</strong> {{ $portfolio->event_date?->format('M d, Y') ?? '—' }}</p>
<p><strong>Status:</strong> {{ $portfolio->is_active ? 'Active' : 'Inactive' }}</p>
@if($portfolio->description)<p>{{ $portfolio->description }}</p>@endif
</div></div>
<a href="{{ route('admin.portfolios.index') }}" class="btn btn-outline-secondary mt-3">Back</a>
@endsection
