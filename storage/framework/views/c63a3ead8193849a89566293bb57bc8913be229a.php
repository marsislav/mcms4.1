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
</head>
<body>

<!--header-->
<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!--/header-->

<section class="page-banner-section pt-75 pb-75 img-bg"
         style="background-image: url(<?php echo e(asset('app/img/bg/common-bg.jpg')); ?>)">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="banner-content">
                    <h2 class="text-white"><?php echo e($pfcategory->name); ?></h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item" aria-current="page">Portfolio</li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo e($pfcategory->name); ?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="blog-section pt-130 pb-100">
    <div class="container">
        <div class="row">
            <?php $__currentLoopData = $pfcategory->pfposts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pfpost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 col-xl-4 mb-60">
                    <div class="single-blog blog-style-2 wow fadeInUp" data-wow-delay=".2s"
                         style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                        <div class="blog-img">
                            <a href="<?php echo e(route('pfpost.single', ['slug' => $pfpost->slug])); ?>">
                                <img src="<?php echo e(asset($pfpost->featured)); ?>" alt="<?php echo e($pfpost->title); ?>" style="width:100%; height:220px; object-fit:cover;">
                            </a>
                        </div>
                        <div class="blog-content" style="padding: 20px 0;">
                            <a href="<?php echo e(route('pfpost.single', ['slug' => $pfpost->slug])); ?>">
                                <h4 class="case-item__title"><?php echo e($pfpost->title); ?></h4>
                            </a>
                            <p><?php echo e(Illuminate\Support\Str::limit(strip_tags($pfpost->content), 120, '...')); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php if($pfcategory->description): ?>
            <div class="description mt-30"><?php echo $pfcategory->description; ?></div>
        <?php endif; ?>
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
                <?php echo $__env->make('includes.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- End Footer -->

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
</body>
</html><?php /**PATH /home/marsisla/public_html/resources/views/pfcategory.blade.php ENDPATH**/ ?>