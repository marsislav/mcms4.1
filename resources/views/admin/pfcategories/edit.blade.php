@extends('layouts.app')

@section('content')

    @include('admin.includes.errors')

    <div class="panel panel-default">
        <div class="panel-heading">
            Update portfolio category: {{ $pfcategory->name }}
        </div>

        <div class="panel-body">
            <form action="{{ route('pfcategory.update', ['id' => $pfcategory->id]) }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{ $pfcategory->name }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="content" cols="30" rows="10" class="form-control">{{ $pfcategory->description }}</textarea>
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">
                            Update portfolio category
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
@stop

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
    <script>
        $(document).ready(function() {
            $('#content').summernote();
        });
    </script>
@stop
