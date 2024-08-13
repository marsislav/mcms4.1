@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('pfcategory.create') }}" class="btn btn-success">Add portfolio category</a>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            Portfolio Categories
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <th>
                    Portfolio category name
                </th>
                <th>
                    Editing
                </th>
                <th>
                    Deleting
                </th>
                </thead>

                <tbody>
                @if($pfcategories->count() > 0)
                    @foreach($pfcategories as $pfcategory)
                        <tr>
                            <td>
                                {{ $pfcategory->name }}
                            </td>
                            <td>
                                <a href="{{ route('pfcategory.edit', ['id' => $pfcategory->id ]) }}" class="btn btn-xs btn-info">
                                    Edit
                                </a>
                            </td>

                            <td>
                                <a href="{{ route('pfcategory.delete', ['id' => $pfcategory->id ]) }}" class="btn btn-xs btn-danger">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th colspan="5" class="text-center">No portfolio categories yet.</th>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection
