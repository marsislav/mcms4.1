<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'mCMS 4.1') }} — Admin</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
    <style>
        /* ✨ Notification badge pulse animation */
        .badge-notify {
            position: absolute;
            top: -4px;
            right: -8px;
            font-size: 0.65rem;
            padding: 3px 6px;
            border-radius: 50px;
            animation: pulse-badge 1.5s infinite;
        }
        @keyframes pulse-badge {
            0%, 100% { transform: scale(1); }
            50%       { transform: scale(1.25); }
        }
        .nav-notify-wrap { position: relative; display: inline-block; }

        /* ✨ Live search highlight */
        .search-highlight { background: #fff3cd; }

        #admin-search-wrap { margin-bottom: 10px; }
    </style>
</head>
<body>
<div id="app">

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('error') }}
        </div>
    @endif
    @if(session('info'))
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('info') }}
        </div>
    @endif

    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'mCMS') }}
                </a>
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    @guest
                        <li><a href="{{ url('/login') }}">Login</a></li>
                    @else
                        <li><a href="{{ url('/') }}">← View Site</a></li>

                        {{-- ✨ EXTRA: Notification badge for unread messages --}}
                        <li>
                            <a href="{{ route('get.messages') }}" style="position:relative;">
                                <span class="nav-notify-wrap">
                                    💬 Messages
                                    <span id="msg-badge"
                                          class="badge badge-danger badge-notify"
                                          style="display:none;">0</span>
                                </span>
                            </a>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('user.profile') }}">My Profile</a>
                                </li>
                                <li>
                                    <a href="{{ url('/logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            @auth
            <div class="col-lg-3">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-info">
                        <a href="{{ route('home') }}"><strong>🏠 Dashboard</strong></a>
                    </li>
                </ul>
                <ul class="list-group">
                    <li class="list-group-item"><a href="{{ route('posts') }}">📝 Posts</a></li>
                    <li class="list-group-item"><a href="{{ route('categories') }}">📂 Categories</a></li>
                    <li class="list-group-item"><a href="{{ route('tags') }}">🏷️ Tags</a></li>
                    <li class="list-group-item"><a href="{{ route('pages') }}">📄 Pages</a></li>
                    <li class="list-group-item"><a href="{{ route('pfposts') }}">🖼️ Portfolio Items</a></li>
                    <li class="list-group-item"><a href="{{ route('pfcategories') }}">🗂️ Portfolio Categories</a></li>
                    <li class="list-group-item"><a href="{{ route('settings') }}">⚙️ Settings</a></li>
                    <li class="list-group-item"><a href="{{ route('menu.index') }}">🧭 Menu Builder</a></li>
                    @if(Auth::user()->admin)
                        <li class="list-group-item"><a href="{{ route('users') }}">👥 Users</a></li>
                    @endif
                    <li class="list-group-item"><a href="{{ route('user.profile') }}">👤 My Profile</a></li>
                </ul>
                <ul class="list-group">
                    <li class="list-group-item"><a href="{{ route('posts.trashed') }}">🗑️ Trashed Posts</a></li>
                    <li class="list-group-item"><a href="{{ route('pfposts.trashed') }}">🗑️ Trashed Portfolio</a></li>
                </ul>
            </div>
            @endauth
            <div class="{{ Auth::check() ? 'col-lg-9' : 'col-lg-12' }}">
                @yield('content')
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>

{{-- ✨ EXTRA: Notification badge — polls unread message count every 30s --}}
@auth
<script>
function fetchUnreadCount() {
    fetch('{{ route('messages.unread.count') }}', {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(r => r.json())
    .then(data => {
        const badge = document.getElementById('msg-badge');
        if (data.count > 0) {
            badge.textContent = data.count;
            badge.style.display = 'inline-block';
        } else {
            badge.style.display = 'none';
        }
    })
    .catch(() => {});
}
fetchUnreadCount();
setInterval(fetchUnreadCount, 30000);
</script>
@endauth

@yield('scripts')
</body>
</html>
