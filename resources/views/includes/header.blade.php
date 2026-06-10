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

                            {{-- ✨ Dynamic Menu from Menu Builder --}}
                            @if(isset($menuItems) && $menuItems->count() > 0)
                                @foreach($menuItems as $item)
                                    @if($item->children->count())
                                        {{-- Dropdown item --}}
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="{{ $item->resolveUrl() }}"
                                               data-bs-toggle="dropdown" role="button">
                                                {{ $item->label }}
                                            </a>
                                            <ul class="dropdown-menu">
                                                @foreach($item->children as $child)
                                                    <li>
                                                        <a class="dropdown-item" href="{{ $child->resolveUrl() }}">
                                                            {{ $child->label }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else
                                        {{-- Simple item --}}
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ $item->resolveUrl() }}">
                                                {{ $item->label }}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            @else
                                {{-- Fallback: show pages (old behaviour) --}}
                                @foreach($pages as $page)
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('page.single', ['slug' => $page->slug]) }}">
                                            {{ $page->name }}
                                        </a>
                                    </li>
                                @endforeach
                            @endif

                            @if(Auth::check())
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('admin') }}">Администрация</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('admin/user/profile') }}">
                                        {{ Auth::user()->name }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="nav-link btn btn-link"
                                                style="padding:0;border:none;background:none;cursor:pointer;">
                                            Изход
                                        </button>
                                    </form>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/login') }}">Вход</a>
                                </li>
                            @endif

                        </ul>

                        @include('includes.search')
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
