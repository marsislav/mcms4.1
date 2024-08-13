@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('pfpost.create') }}" class="btn btn-success">Add Portfolio item</a>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Published portfolio items
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <th>
                    Image
                </th>
                <th>
                    Title
                </th>
                <th>
                    Edit
                </th>
                <th>
                    Trash
                </th>
                </thead>

                <tbody>
                @if($pfposts->count() > 0)
                    @foreach($pfposts as $pfpost)
                        <tr>
                            <td><img src="{{ $pfpost->featured }}" alt="{{ $pfpost->title }}" width="90px" height="50px"></td>
                            <td>{{ $pfpost->title }}</td>
                            <td>
                                <a href="{{ route('pfpost.edit', ['id' => $pfpost->id]) }}" class="btn btn-xs btn-info">Edit</a>
                            </td>

                            <td>
                                <a href="{{ route('pfpost.delete', ['id' => $pfpost->id]) }}" class="btn btn-xs btn-danger">Trash</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th colspan="5" class="text-center">No published portfolio items</th>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>

@stop
