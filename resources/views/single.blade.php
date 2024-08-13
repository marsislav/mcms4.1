<!DOCTYPE html>
<!-- saved from url=(0051)https://demo.graygrids.com/themes/space/blog-1.html -->
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


<body>
<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
    your browser</a> to improve your experience and security.</p>
<![endif]-->

<div class="preloader" style="opacity: 0; display: none;">
    <div class="loader">
        <div class="spinner">
            <div class="spinner-container">
                <div class="spinner-rotator">
                    <div class="spinner-left">
                        <div class="spinner-circle"></div>
                    </div>
                    <div class="spinner-right">
                        <div class="spinner-circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--header-->
@include('includes.header')
<!--/header-->

<section class="page-banner-section pt-75 pb-75 img-bg"
         style="background-image: url({{ asset('app/img/bg/common-bg.jpg')}})">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="banner-content">
                    <h2 class="text-white">{{ $post->title }}</h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item" aria-current="page">Category</li>
                                <li class="breadcrumb-item active" aria-current="page"><a
                                        href="{{ route('category.single', ['id' => $post->category->id ]) }}">{{$post->category->name}}</a>
                                </li>
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
                <div class="left-side-wrapper">
                    <div class="single-blog blog-style-2 mb-60 wow fadeInUp" data-wow-delay=".2s"
                         style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                        <div class="blog-img">
                            <img src="{{asset( $post->featured)}}" alt="{{ $post->title }}">
                        </div>
                        <div class="blog-content">

                            <div class="blog-meta">

                                <span class="date"><i class="lni lni-calendar"></i> {{ $post->created_at->toFormattedDateString() }}</span>
                                <span class="category"><i class="lni lni-folder"></i> <a
                                        href="{{ route('category.single', ['id' => $post->category->id ]) }}">{{ $post->category->name }}</a> </span>
                                <span class="category"><i class="lni lni-user"></i> {{ $post->user->name }} </span>
                            </div>

                            <div class="actual_content">{!! $post->content !!}</div>
                        </div>
                        <div class="tags-box">
                            <ul>
                                @foreach($post->tags as $tag)
                                    <li><a href="{{ route('tag.single', ['id' => $tag->id ]) }}"
                                           class="w-tags-item">{{ $tag->tag }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="blog-details-author">
                        <div class="row">
                        <div class="col-lg-3">
                            <div class="blog-details-author-thumb">
                                <img src="{{ asset($post->user->profile->avatar) }}" alt="Author">
                            </div>
                        </div>

                        <div class="col-lg-9">
                        <div class="blog-details-author-content">
                            <div class="author-info">
                                <h5 class="author-name">{{ $post->user->name }}</h5>
                            </div>
                            <p class="text">{{ $post->user->profile->about }}
                            </p>
                            <div class="socials">

                                <a href="{{ $post->user->profile->facebook }}" class="social__item" target="_blank">
                                    <img src="{{ asset('app/svg/circle-facebook.svg') }}" alt="facebook">
                                </a>

                                <a href="{{ $post->user->profile->youtube }}" class="social__item" target="_blank">
                                    <img src="{{ asset('app/svg/youtube.svg') }}" alt="youtube">
                                </a>

                            </div>
                        </div>
                        </div>
                        </div>
                    </div>


                    <div class="pagination">
                        <ul class="d-flex justify-content-center align-items-center">
                            @if($prev)
                                <li><a href="{{ route('post.single', ['slug' => $prev->slug ]) }}"><i
                                            class="lni lni-arrow-left"></i> {{ $prev->title }}</a></li>
                            @endif
                            @if($next)
                                <li><a href="{{ route('post.single', ['slug' => $next->slug ]) }}">{{ $next->title }} <i
                                            class="lni lni-arrow-right"></i></a></li>
                            @endif


                        </ul>
                    </div>

                    <div class="comments">

                        <div class="heading text-center">
                            <h4 class="h1 heading-title">Comments</h4>
                            <div class="heading-line">
                                <span class="short-line"></span>
                                <span class="long-line"></span>
                            </div>
                        </div>

                        @include('includes.comments')
                    </div>
                </div>
            </div>
            @include('includes.sidebar')
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

<!-- Footer -->

@include('includes.footer')

<!-- End Footer -->


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

</body>
</html>

