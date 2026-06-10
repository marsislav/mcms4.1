<!DOCTYPE html>
<html class="no-js" lang="">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo e($title); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('assets/img/favicon.png')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('app/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('app/css/LineIcons.2.0.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('app/css/animate.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('app/css/tiny-slider.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('app/css/glightbox.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('app/css/main.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/toastr.min.css')); ?>">
</head>
<body>

<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="page-banner-section pt-75 pb-75 img-bg"
         style="background-image: url(<?php echo e(asset('app/img/bg/common-bg.jpg')); ?>)">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="banner-content">
                    <h2 class="text-white">Категория: <?php echo e($category->name); ?></h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item" aria-current="page">Категория</li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo e($category->name); ?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="blog-section pt-130 pb-130">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="left-side-wrapper">
                    <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="single-blog mb-50 wow fadeInUp" data-wow-delay=".2s">
                            <div class="blog-img mb-25">
                                <a href="<?php echo e(route('post.single', ['slug' => $post->slug])); ?>">
                                    <img src="<?php echo e(asset($post->featured)); ?>" alt="<?php echo e($post->title); ?>" class="img-fluid w-100" style="border-radius:8px; max-height:320px; object-fit:cover;">
                                </a>
                            </div>
                            <div class="blog-content">
                                <div class="blog-meta mb-10">
                                    <span class="date"><i class="lni lni-calendar"></i> <?php echo e($post->created_at->toFormattedDateString()); ?></span>
                                    <span class="ms-3"><i class="lni lni-folder"></i>
                                        <a href="<?php echo e(route('category.single', ['slug' => $category->slug])); ?>"><?php echo e($post->category->name); ?></a>
                                    </span>
                                    <span class="ms-3"><i class="lni lni-user"></i> <?php echo e($post->user->name); ?></span>
                                </div>
                                <a href="<?php echo e(route('post.single', ['slug' => $post->slug])); ?>">
                                    <h4 class="case-item__title mb-15"><?php echo e($post->title); ?></h4>
                                </a>
                                <p><?php echo \Illuminate\Support\Str::limit(strip_tags($post->content), 250, '...'); ?></p>
                            </div>
                        </div>
                        <hr class="mb-50">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p>Няма публикации в тази категория.</p>
                    <?php endif; ?>

                    <div class="mt-40">
                        <?php echo e($posts->links()); ?>

                    </div>
                </div>
            </div>

            <?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</section>

<section id="contact" class="contact-section cta-bg img-bg pt-110 pb-100">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 col-lg-6">
                <div class="section-title mb-30">
                    <span class="text-white wow fadeInDown" data-wow-delay=".2s">Имате въпроси?</span>
                    <h2 class="text-white mb-40 wow fadeInUp" data-wow-delay=".4s">Пишете ми!</h2>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <?php echo $__env->make('includes.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
</section>

<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<a href="#" class="scroll-top">
    <i class="lni lni-arrow-up"></i>
</a>

<script src="<?php echo e(asset('app/js/jquery-2.1.4.min.js')); ?>"></script>
<script src="<?php echo e(asset('app/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('app/js/contact-form.js')); ?>"></script>
<script src="<?php echo e(asset('app/js/count-up.min.js')); ?>"></script>
<script src="<?php echo e(asset('app/js/tiny-slider.js')); ?>"></script>
<script src="<?php echo e(asset('app/js/isotope.min.js')); ?>"></script>
<script src="<?php echo e(asset('app/js/glightbox.min.js')); ?>"></script>
<script src="<?php echo e(asset('app/js/wow.min.js')); ?>"></script>
<script src="<?php echo e(asset('app/js/imagesloaded.min.js')); ?>"></script>
<script src="<?php echo e(asset('app/js/main.js')); ?>"></script>
<script src="<?php echo e(asset('js/toastr.min.js')); ?>"></script>

<script>
    <?php if(Session::has('subscribed')): ?>
    toastr.success("<?php echo e(Session::get('subscribed')); ?>");
    <?php endif; ?>
</script>
</body>
</html><?php /**PATH /home/marsisla/public_html/resources/views/category.blade.php ENDPATH**/ ?>