@extends('layouts.app')

@section('content')

    @include('admin.includes.errors')

    <div class="panel panel-default">
        <div class="panel-heading">
            Create a new portfolio item
        </div>

        <div class="panel-body">
            <form action="{{ route('pfpost.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="project_title">Project Title (opional)</label>
                    <input type="text" name="project_title" class="form-control">
                </div>

                <div class="form-group">
                    <label for="completed_at">Completed at</label>
                    <input type="text" name="completed_at" class="form-control">
                </div>

                <div class="form-group">
                    <label for="skills">Skills</label>
                    <input type="text" name="skills" class="form-control">
                </div>

                <div class="form-group">
                    <label for="completed_at">Client</label>
                    <input type="text" name="client" class="form-control">
                </div>

                <div class="form-group">
                    <label for="client_url">Client URL</label>
                    <input type="text" name="client_url" class="form-control">
                </div>

                <div class="form-group">
                    <label for="featured">Featured image</label>
                    <input type="file" name="featured" class="form-control">
                </div>
                <div class="form-group">
                    <label for="pfcategory">Select a portfolio category</label>
                    <select name="pfcategory_id" id="pfcategory" class="form-control">
                        @foreach($pfcategories as $pfcategory)
                            <option value="{{ $pfcategory->id }}">{{ $pfcategory->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" cols="5" rows="5" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">
                            Store portfolio item
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
