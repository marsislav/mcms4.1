@extends('layouts.app')

@section('content')
    <div class="row">
        {{-- Stats cards --}}
        <div class="col-lg-3 col-md-6">
            <div class="card text-center mb-3 border-primary">
                <div class="card-header bg-primary text-white">📝 POSTS</div>
                <div class="card-body"><h2>{{ $posts_count }}</h2></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card text-center mb-3 border-danger">
                <div class="card-header bg-danger text-white">🗑️ TRASHED</div>
                <div class="card-body"><h2>{{ $trashed_count }}</h2></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card text-center mb-3 border-success">
                <div class="card-header bg-success text-white">🖼️ PORTFOLIO</div>
                <div class="card-body"><h2>{{ $pfposts_count }}</h2></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card text-center mb-3 border-info">
                <div class="card-header bg-info text-white">👥 USERS</div>
                <div class="card-body"><h2>{{ $users_count }}</h2></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card text-center mb-3">
                <div class="card-header">🏷️ TAGS</div>
                <div class="card-body"><h2>{{ $tags_count }}</h2></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card text-center mb-3">
                <div class="card-header">📂 CATEGORIES</div>
                <div class="card-body"><h2>{{ $categories_count }}</h2></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card text-center mb-3">
                <div class="card-header">📄 PAGES</div>
                <div class="card-body"><h2>{{ $pages_count }}</h2></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card text-center mb-3">
                <div class="card-header">🗂️ PF CATEGORIES</div>
                <div class="card-body"><h2>{{ $pfcategories_count }}</h2></div>
            </div>
        </div>
    </div>

    {{-- ✨ EXTRA: Activity Log --}}
    <div class="panel panel-default mt-3">
        <div class="panel-heading"><strong>🕒 Recent Activity</strong></div>
        <div class="panel-body" style="padding:0;">
            @if($recent_activity->count() > 0)
                <ul class="list-group list-group-flush" id="activity-log">
                    @foreach($recent_activity as $log)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <span style="font-size:1.2em;">{{ $log->icon }}</span>
                                <strong>{{ $log->user->name ?? 'Unknown' }}</strong>
                                {{ $log->action }}:
                                <em>{{ $log->subject }}</em>
                            </span>
                            <small class="text-muted">{{ $log->created_at->diffForHumans() }}</small>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted text-center p-3">No activity yet.</p>
            @endif
        </div>
    </div>
@endsection
