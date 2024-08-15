<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    @yield('styles')

    <!-- Scripts -->
    <script>
    window.Laravel = {
        csrfToken: @json(csrf_token())
    };
</script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                            style="display: none;">
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
                    <div class="col-lg-4">
                        <ul class="list-group">
                            <li class="list-group-item bg-info">
                                <a href="{{ route('get.messages') }}">Messages</a>
                            </li>
                        </ul>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="{{ route('home') }}">Dashboard</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('posts') }}">Posts</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('categories') }}">Categories</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('tags') }}">Tags</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('pages') }}">Pages</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('pfposts') }}">Portfolio items</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('pfcategories') }}">Portfolio categories</a>
                            </li>
                            <li class="list-group-item">
                                    <a href="{{ route('settings') }}">Settings</a>
                                </li>

                            @if (Auth::user()->admin)
                                <li class="list-group-item">
                                    <a href="{{ route('users') }}">Users</a>
                                </li>
                               
                            @endif
                            <li class="list-group-item">
                                <a href="{{ route('user.profile') }}">My profile</a>
                            </li>
                        </ul>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="{{ route('posts.trashed') }}">All trashed posts</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('pfposts.trashed') }}">All trashed portfolio items</a>
                            </li>
                        </ul>
                    </div>
                @endauth
                <div class="col-lg-8">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
     @if (Session::has('success'))
    <script>
       
            toastr.success("{{ Session::get('success') }}");
        
        </script>
        @endif
        
        @if (Session::has('info'))
        <script>
            toastr.info("{{ Session::get('info') }}"); 
        </script>
        @endif
   

    @yield('scripts')
</body>

</html>
