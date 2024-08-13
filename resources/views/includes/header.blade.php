<header class="header bg-white navbar-area">
    @include('includes.contactsInfo')

    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand" href="/">
                        @if($settings->logo)
                            <img src="{{ asset($settings->logo) }}" alt="{{ $settings->site_name }} Logo">
                        @else
                            {{ $settings->site_name }}
                        @endif
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="toggler-icon"></span>
                        <span class="toggler-icon"></span>
                        <span class="toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                        <ul id="nav" class="navbar-nav ms-auto">
                            @foreach ($pages as $page)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('page.single', ['id' => $page->id]) }}">
                                        {{ $page->name }}
                                    </a>
                                </li>
                            @endforeach

                            @if (Auth::check())
                                <li class="nav-item"><a class="nav-link" href="{{ url('admin') }}">Admin Dashboard</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ url('admin/user/profile') }}">
                                    {{ Auth::user()->name }}
                                </a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ url('/logout') }}">Logout</a></li>
                            @else
                                <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">Login</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ url('/register') }}">Register</a></li>
                            @endif
                        </ul>

                        @include('includes.search')
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
