@extends('layouts.app')

@section('content')
    <h1>Messages</h1>
    @if(count($messages) > 0)
        @foreach($messages as $message)
            <ul class="list-group">
                <li class="list-group-item">Name: {{$message->name}}</li>
                <li class="list-group-item">Email: {{$message->email}}</li>
                <li class="list-group-item">Message: {{$message->message}}</li>
                <li class="list-group-item">
                    <form action="{{ route('messages.delete', $message->id) }}" method="GET" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </li>
            </ul>
        @endforeach
        {{ $messages->links() }} <!-- Add pagination links if needed -->
    @endif
@endsection
