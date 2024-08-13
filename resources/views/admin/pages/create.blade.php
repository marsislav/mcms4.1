@extends('layouts.app')

@section('content')

      @include('admin.includes.errors')

      <div class="panel panel-default">
            <div class="panel-heading">
                  Create a new page
            </div>

            <div class="panel-body">
                  <form action="{{ route('page.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                              <label for="name">Name</label>
                              <input type="text" name="name" class="form-control">

                        </div>
                        <div class="form-group">
                              <label for="position">Navigation position</label>
                              <input type="text" name="position" class="form-control">
                              
                        </div>
                        <div class="form-group">
                              <label for="content">Content</label>
                              <textarea name="content" id="content" cols="30" rows="10"></textarea>
                              
                        </div>
                        <div class="form-group">
                              <div class="text-center">
                                    <button class="btn btn-success" type="submit">
                                          Store page
                                    </button>
                              </div>
                        </div>
                  </form>
            </div>
      </div>
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