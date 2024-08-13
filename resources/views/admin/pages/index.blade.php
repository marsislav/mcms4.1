@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end mb-2">
  <a href="{{ route('page.create') }}" class="btn btn-success">Add Page</a>
</div>

      <div class="panel panel-default">
            <div class="panel-heading">
                  Categories
            </div>
            <div class="panel-body">
                  <table class="table table-hover">
                        <thead>
                              <th>
                                    Category name
                              </th>
                              <th>
                                    Editing 
                              </th>
                              <th>
                                    Deleting
                              </th>
                        </thead>

                        <tbody>
                              @if($pages->count() > 0)
                                    @foreach($pages as $page)
                                          <tr>
                                                <td>
                                                      {{ $page->name }}
                                                </td>
                                                <td>
                                                      <a href="{{ route('page.edit', ['id' => $page->id ]) }}" class="btn btn-xs btn-info">
                                                            Edit
                                                      </a>
                                                </td>

                                                <td>
                                                      <a href="{{ route('page.delete', ['id' => $page->id ]) }}" class="btn btn-xs btn-danger">
                                                            Delete
                                                      </a>
                                                </td>
                                          </tr>
                                    @endforeach
                              @else
                                     <tr>
                                          <th colspan="5" class="text-center">No categories yet.</th>
                                    </tr>
                              @endif
                        </tbody>
                  </table>
            </div>
      </div>

@stop