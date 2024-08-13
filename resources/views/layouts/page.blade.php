<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>{{ $page->name }}</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="{{ asset('app/css/fonts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app/css/crumina-fonts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app/css/normalize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app/css/grid.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app/css/jquery.mCustomScrollbar.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app/css/swiper.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app/css/primary-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app/css/magnific-popup.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" type="text/css">

    <!-- Inline Styles -->
    <style>
        .padded-50 {
            padding: 40px;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        @include('includes.header')
        @yield('content')

        <!-- Subscribe Form -->
        @include('includes.form')
        <!-- End Subscribe Form -->
    </div>

    <!-- Footer -->
    @include('includes.footer')
    <!-- End Footer -->

    <svg style="display:none;">
        <!-- SVG symbols -->
    </svg>

    <!-- Overlay Search -->
    @include('includes.search')
    <!-- End Overlay Search -->

    <!-- JS Scripts -->
    <script src="{{ asset('app/js/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('app/js/crum-mega-menu.js') }}"></script>
    <script src="{{ asset('app/js/swiper.jquery.min.js') }}"></script>
    <script src="{{ asset('app/js/theme-plugins.js') }}"></script>
    <script src="{{ asset('app/js/main.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script src="{{ asset('app/js/velocity.min.js') }}"></script>
    <script src="{{ asset('app/js/ScrollMagic.min.js') }}"></script>
    <script src="{{ asset('app/js/animation.velocity.min.js') }}"></script>

    <!-- Toastr Notification -->
    <script>
        @if(Session::has('subscribed'))
            toastr.success("{{ Session::get('subscribed') }}");
        @endif
    </script>

    <!-- AddThis Script -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-587d79f7e064cbd5"></script> 
</body>
</html>
