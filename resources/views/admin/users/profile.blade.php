@extends('layouts.app')

@section('content')

@include('admin.includes.errors')

<div class="panel panel-default">
    <div class="panel-heading">👤 Edit Your Profile</div>
    <div class="panel-body">
        <form action="{{ route('user.profile.update') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="name" value="{{ $user->name ?? '' }}" class="form-control">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ $user->email ?? '' }}" class="form-control">
            </div>

            <hr>
            <p class="text-muted"><small>Leave password fields empty to keep your current password.</small></p>

            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="password" class="form-control" autocomplete="new-password">
            </div>

            {{-- ✨ Fixed: added password_confirmation field --}}
            <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
            </div>

            <hr>

            <div class="form-group">
                <label>Upload New Avatar</label>
                @if(!empty($user->profile->avatar))
                    <div class="mb-2">
                        <img src="{{ asset($user->profile->avatar) }}" width="70" height="70"
                             style="border-radius:50%; object-fit:cover;">
                    </div>
                @endif
                <input type="file" name="avatar" class="form-control">
            </div>

            <div class="form-group">
                <label>Facebook Profile URL</label>
                <input type="text" name="facebook" value="{{ $user->profile->facebook ?? '' }}" class="form-control">
            </div>

            <div class="form-group">
                <label>YouTube Profile URL</label>
                <input type="text" name="youtube" value="{{ $user->profile->youtube ?? '' }}" class="form-control">
            </div>

            <div class="form-group">
                <label>About You</label>
                <textarea name="about" rows="6" class="form-control">{{ $user->profile->about ?? '' }}</textarea>
            </div>

            <div class="form-group text-center">
                <button class="btn btn-success" type="submit">Update Profile</button>
            </div>
        </form>
    </div>
</div>

@endsection
