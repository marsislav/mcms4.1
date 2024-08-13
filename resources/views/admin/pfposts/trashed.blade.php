@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Trashed portfolio items
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
                    Restore
                </th>
                <th>
                    Destroy
                </th>
                </thead>

                <tbody>
                @if($pfposts->count() > 0)
                    @foreach($pfposts as $pfpost)
                        <tr>
                            <td><img src="{{ $pfpost->featured }}" alt="{{ $pfpost->title }}" width="90px" height="50px"></td>
                            <td>{{ $pfpost->title }}</td>
                            <td>Edit</td>
                            <td>
                                <a href="{{ route('pfpost.restore', ['id' => $pfpost->id]) }}" class="btn btn-xs btn-success">Restore</a>
                            </td>
                            <td>
                                <a href="{{ route('pfpost.kill', ['id' => $pfpost->id]) }}" class="btn btn-xs btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th colspan="5" class="text-center">No trashed portfolio items</th>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>

@stop
