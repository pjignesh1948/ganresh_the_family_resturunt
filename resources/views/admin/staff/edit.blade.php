@extends('layouts.admin')

@section('title', 'Edit Staff')

@section('content')
<div class="mb-4"><h1 class="h3 mb-0">Edit Staff Member</h1></div>
<div class="card shadow-sm"><div class="card-body">
<form action="{{ route('admin.staff.update', $staff) }}" method="POST" enctype="multipart/form-data">@csrf @method('PUT')
    @include('admin.staff._form', ['staff' => $staff])
    <div class="mt-3">
        <button type="submit" class="btn btn-accent">Update</button>
        <a href="{{ route('admin.staff.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </div>
</form></div></div>
@endsection
