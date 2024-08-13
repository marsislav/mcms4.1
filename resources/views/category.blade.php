<!DOCTYPE html>
<html class="no-js" lang="">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png')}}">
    <link rel="stylesheet" href="{{ asset('app/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('app/css/LineIcons.2.0.css')}}">
    <link rel="stylesheet" href="{{ asset('app/css/animate.css')}}">
    <link rel="stylesheet" href="{{ asset('app/css/tiny-slider.css')}}">
    <link rel="stylesheet" href="{{ asset('app/css/glightbox.min.css')}}">
    <link rel="stylesheet" href="{{ asset('app/css/main.css')}}">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
</head>
<body>

@include('includes.header')

<section class="page-banner-section pt-75 pb-75 img-bg"
         style="background-image: url({{ asset('app/img/bg/common-bg.jpg')}})">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="banner-content">
                    <h2 class="text-white">Category: {{ $category->name }}</h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item" aria-current="page">Category</li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="blog-section pt-130">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                @foreach($category->posts as $post)
                    <div class="left-side-wrapper">
                        <div class="single-blog blog-style-2 mb-60 wow fadeInUp" data-wow-delay=".2s"
                             style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                            <div class="row">
                                <div class="col-xl-5"> 
                                    <div class="blog-img">
                                        <a href="{{ route('post.single', ['slug' => $post->slug ]) }}">
                                            <img src="{{ asset($post->featured) }}" alt="{{ $post->title }}">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xl-7"> 
                                    <div class="blog-content">
                                        <a href="{{ route('post.single', ['slug' => $post->slug ]) }}">
                                            <h4 class="case-item__title">{{ $post->title }}</h4>
                                        </a>
                                        <div class="blog-meta">
                                            <span class="date"><i class="lni lni-calendar"></i> {{ $post->created_at->toFormattedDateString() }}</span>
                                            <span class="category"><i class="lni lni-folder"></i> <a href="{{ route('category.single', ['id' => $category->id ]) }}">{{ $post->category->name }}</a></span>
                                            <span class="category"><i class="lni lni-user"></i> {{ $post->user->name }}</span>
                                        </div>
                                        {!! \Illuminate\Support\Str::limit($post->content, 350, '...') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-xl-4 col-lg-5">
                <div class="sidebar-wrapper">
                    <div class="sidebar-box search-form-box mb-30">
                        @include('includes.search')
                    </div>

                    <div class="sidebar-box catagories-box mb-30">
                        <h4>Categories</h4>
                        <ul>
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('category.single', ['id' => $category->id ]) }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="sidebar-box mb-30">
                        <h4>Follow On</h4>
                        <div class="footer-social-links">
                            <ul class="d-flex justify-content-start">
                                <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-twitter-filled"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-linkedin-original"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-instagram-filled"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="contact" class="contact-section cta-bg img-bg pt-110 pb-100">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 col-lg-6">
                <div class="section-title mb-30">
                    <span class="text-white wow fadeInDown" data-wow-delay=".2s"
                          style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInDown;">Questions?</span>
                    <h2 class="text-white mb-40 wow fadeInUp" data-wow-delay=".4s"
                        style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">Ask me!</h2>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                @include('includes.form')
            </div>
        </div>
    </div>
</section>

@include('includes.footer')

<a href="#" class="scroll-top">
    <i class="lni lni-arrow-up"></i>
</a>

<script src="{{ asset('app/js/jquery-2.1.4.min.js')}}"></script>
<script src="{{ asset('app/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('app/js/contact-form.js')}}"></script>
<script src="{{ asset('app/js/count-up.min.js')}}"></script>
<script src="{{ asset('app/js/tiny-slider.js')}}"></script>
<script src="{{ asset('app/js/isotope.min.js')}}"></script>
<script src="{{ asset('app/js/glightbox.min.js')}}"></script>
<script src="{{ asset('app/js/wow.min.js')}}"></script>
<script src="{{ asset('app/js/imagesloaded.min.js')}}"></script>
<script src="{{ asset('app/js/main.js')}}"></script>
<script src="{{ asset('js/toastr.min.js') }}"></script>

<script>
    @if(Session::has('subscribed'))
    toastr.success("{{ Session::get('subscribed') }}");
    @endif
</script>
</body>
</html>
