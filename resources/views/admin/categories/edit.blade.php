@extends('layouts.app')

@section('content')

    @include('admin.includes.errors')

    <div class="panel panel-default">
        <div class="panel-heading">
            Edit Category
        </div>

        <div class="panel-body">
            <form action="{{ route('category.update', $category->id) }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text"
                           name="name"
                           id="name"
                           class="form-control"
                           value="{{ old('name', $category->name) }}"
                           required>
                </div>

                <div class="form-group text-center">
                    <button class="btn btn-success" type="submit">Update Category</button>
                    <a href="{{ route('categories') }}" class="btn btn-default ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>

@endsection
