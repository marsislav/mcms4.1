@extends('layouts.app')

@section('content')

      @include('admin.includes.errors')

      <div class="panel panel-default">
            <div class="panel-heading">
                  Create a new user
            </div>

            <div class="panel-body">
                  <form action="{{ route('user.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                              <label for="name">Username</label>
                              <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                              <label for="email">Email</label>
                              <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                              <label for="password">Password</label>
                              <input type="password" name="password" class="form-control" required minlength="8">
                        </div>

                        <div class="form-group">
                              <label for="password_confirmation">Confirm Password</label>
                              <input type="password" name="password_confirmation" class="form-control" required minlength="8">
                        </div>

                        <div class="form-group">
                              <div class="checkbox">
                                    <label>
                                          <input type="checkbox" name="admin" value="1"> Administrator
                                    </label>
                              </div>
                        </div>

                        <div class="form-group">
                              <div class="text-center">
                                    <button class="btn btn-success" type="submit">
                                          Add user
                                    </button>
                              </div>
                        </div>
                  </form>
            </div>
      </div>
@stop
