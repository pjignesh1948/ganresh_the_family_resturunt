@extends('layouts.admin')

@section('title', 'Message from ' . $contactMessage->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h1 class="h3 mb-0">Message from {{ $contactMessage->name }}</h1>
    <form action="{{ route('admin.contact-messages.destroy', $contactMessage) }}" method="POST" onsubmit="return confirm('Delete this message?')">@csrf @method('DELETE')<button type="submit" class="btn btn-outline-danger btn-sm">Delete</button></form>
</div>
<div class="card shadow-sm"><div class="card-body">
    <div class="row mb-3">
        <div class="col-md-6"><strong>Email:</strong> {{ $contactMessage->email ?? '—' }}</div>
        <div class="col-md-6"><strong>Phone:</strong> {{ $contactMessage->phone ?? '—' }}</div>
    </div>
    @if($contactMessage->subject)<p><strong>Subject:</strong> {{ $contactMessage->subject }}</p>@endif
    <p><strong>Received:</strong> {{ $contactMessage->created_at->format('M d, Y h:i A') }}</p>
    <hr>
    <div>{!! nl2br(e($contactMessage->message)) !!}</div>
</div></div>
<a href="{{ route('admin.contact-messages.index') }}" class="btn btn-outline-secondary mt-3">Back</a>
@endsection
