@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">💬 Messages</h4>
    <small class="text-muted">{{ $messages->total() }} total</small>
</div>

@if($messages->count() > 0)
    @foreach($messages as $message)
        <div class="panel panel-default">
            <div class="panel-heading d-flex justify-content-between">
                <span>
                    <strong>{{ $message->name }}</strong>
                    &mdash;
                    <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>
                </span>
                <small class="text-muted">
                    {{ $message->created_at->setTimezone('Europe/Sofia')->format('d M Y, H:i') }}
                </small>
            </div>
            <div class="panel-body">
                <p class="mb-2">{{ $message->message }}</p>
                {{-- ✨ Fixed: DELETE via POST form, not GET link --}}
                <form action="{{ route('messages.delete', $message->id) }}" method="POST"
                      onsubmit="return confirm('Delete this message?');">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-xs">🗑 Delete</button>
                </form>
            </div>
        </div>
    @endforeach

    {{ $messages->links() }}
@else
    <p class="text-muted text-center mt-4">No messages yet.</p>
@endif

@endsection
