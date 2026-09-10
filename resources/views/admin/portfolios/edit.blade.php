@extends('layouts.admin')

@section('title', 'Edit Portfolio Item')

@section('content')
<div class="mb-4"><h1 class="h3 mb-0">Edit Portfolio Item</h1></div>
<div class="card shadow-sm"><div class="card-body">
<form action="{{ route('admin.portfolios.update', $portfolio) }}" method="POST" enctype="multipart/form-data">@csrf @method('PUT')
    <div class="mb-3"><label class="form-label">Title *</label><input type="text" name="title" class="form-control" value="{{ old('title', $portfolio->title) }}" required></div>
    <div class="mb-3"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3">{{ old('description', $portfolio->description) }}</textarea></div>
    <div class="mb-3"><label class="form-label">Image</label>@if($portfolio->image)<div class="mb-2"><img src="{{ asset('storage/'.$portfolio->image) }}" height="80" class="rounded"></div>@endif<input type="file" name="image" class="form-control" accept="image/*"></div>
    <div class="mb-3"><label class="form-label">Event Date</label><input type="date" name="event_date" class="form-control" value="{{ old('event_date', $portfolio->event_date?->format('Y-m-d')) }}"></div>
    <div class="mb-3"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $portfolio->sort_order) }}" min="0"></div>
    <div class="mb-3 form-check"><input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active" {{ old('is_active', $portfolio->is_active) ? 'checked' : '' }}><label class="form-check-label" for="is_active">Active</label></div>
    <button type="submit" class="btn btn-maroon">Update</button> <a href="{{ route('admin.portfolios.index') }}" class="btn btn-outline-secondary">Cancel</a>
</form></div></div>
@endsection
