@extends('layouts.admin')

@section('title', 'Add Founder')

@section('content')
<div class="mb-4"><h1 class="h3 mb-0">Add Founder</h1></div>
<div class="card shadow-sm"><div class="card-body">
<form action="{{ route('admin.founders.store') }}" method="POST" enctype="multipart/form-data">@csrf
    <div class="row g-3">
        <div class="col-md-6"><label class="form-label">Name *</label><input type="text" name="name" class="form-control" required></div>
        <div class="col-md-6"><label class="form-label">Title</label><input type="text" name="title" class="form-control" placeholder="Founder & Head Chef"></div>
        <div class="col-12"><label class="form-label">Bio</label><textarea name="bio" class="form-control" rows="4"></textarea></div>
        <div class="col-md-6"><label class="form-label">Photo</label><input type="file" name="photo" class="form-control" accept="image/*"></div>
        <div class="col-md-3"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="0" min="0"></div>
        <div class="col-md-3 form-check pt-4"><input type="checkbox" name="is_active" value="1" class="form-check-input" id="active" checked><label class="form-check-label" for="active">Active</label></div>
        <div class="col-12"><button type="submit" class="btn btn-accent">Save Founder</button> <a href="{{ route('admin.founders.index') }}" class="btn btn-outline-secondary">Cancel</a></div>
    </div>
</form></div></div>
@endsection
