@extends('layouts.admin')

@section('title', 'Add Staff')

@section('content')
<div class="mb-4"><h1 class="h3 mb-0">Add Staff Member</h1></div>
<div class="card shadow-sm"><div class="card-body">
<form action="{{ route('admin.staff.store') }}" method="POST" enctype="multipart/form-data">@csrf
    @include('admin.staff._form')
    <div class="mt-3">
        <button type="submit" class="btn btn-accent">Create</button>
        <a href="{{ route('admin.staff.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </div>
</form></div></div>
@endsection
