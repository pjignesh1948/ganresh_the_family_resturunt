@extends('layouts.admin')

@section('title', 'Contact Messages')

@section('content')
<div class="mb-4"><h1 class="h3 mb-0">Contact Messages</h1></div>
<div class="card shadow-sm">
    <div class="table-responsive"><table class="table table-hover mb-0 admin-datatable"><thead><tr><th>Name</th><th>Email</th><th>Subject</th><th>Date</th><th>Read</th><th></th></tr></thead>
    <tbody>@forelse($messages as $message)<tr class="{{ !$message->is_read ? 'table-warning' : '' }}"><td>{{ $message->name }}</td><td>{{ $message->email ?? '—' }}</td><td>{{ Str::limit($message->subject ?? $message->message, 40) }}</td><td>{{ $message->created_at->format('M d, Y') }}</td><td>{{ $message->is_read ? 'Yes' : 'No' }}</td><td><a href="{{ route('admin.contact-messages.show', $message) }}" class="btn btn-sm btn-outline-primary">View</a></td></tr>@empty<tr><td colspan="6" class="text-center text-muted py-4">No messages.</td></tr>@endforelse</tbody></table></div>
</div>
@endsection
