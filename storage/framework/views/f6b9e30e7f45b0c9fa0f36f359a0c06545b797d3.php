<!DOCTYPE html>
<html lang="en">

<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo e($title ?? 'Default Title'); ?></title>

    <!-- CSS Links -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app/css/fonts.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app/css/crumina-fonts.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app/css/normalize.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app/css/grid.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app/css/styles.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/toastr.min.css')); ?>">

    <!-- Plugins Styles -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app/css/jquery.mCustomScrollbar.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app/css/swiper.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app/css/primary-menu.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app/css/magnific-popup.css')); ?>">

    <!-- External Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" type="text/css">

    <!-- Inline Styles (Consider moving to external CSS) -->
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
    <?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('content'); ?>

    <!-- Subscribe Form -->
    <?php echo $__env->make('includes.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- End Subscribe Form -->
</div>

<!-- Footer -->
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- End Footer -->

<svg style="display:none;">
    <!-- SVG symbols (ensure they are used if needed) -->
    <symbol id="arrow-left" viewBox="122.9 388.2 184.3 85">
        <!-- Path data here -->
    </symbol>
    <symbol id="arrow-right" viewBox="122.9 388.2 184.3 85">
        <!-- Path data here -->
    </symbol>
    <symbol id="to-top" viewBox="0 0 32 32">
        <!-- Path data here -->
    </symbol>
</svg>

<!-- Overlay Search -->
<?php echo $__env->make('includes.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- End Overlay Search -->

<!-- JS Script -->
<script src="<?php echo e(asset('app/js/jquery-2.1.4.min.js')); ?>"></script>
<script src="<?php echo e(asset('app/js/crum-mega-menu.js')); ?>"></script>
<script src="<?php echo e(asset('app/js/swiper.jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('app/js/theme-plugins.js')); ?>"></script>
<script src="<?php echo e(asset('app/js/main.js')); ?>"></script>
<script src="<?php echo e(asset('js/toastr.min.js')); ?>"></script>
<script src="<?php echo e(asset('app/js/velocity.min.js')); ?>"></script>
<script src="<?php echo e(asset('app/js/ScrollMagic.min.js')); ?>"></script>
<script src="<?php echo e(asset('app/js/animation.velocity.min.js')); ?>"></script>

<script>
    <?php if(Session::has('subscribed')): ?>
        toastr.success("<?php echo e(Session::get('subscribed')); ?>");
    <?php endif; ?>
</script>

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-587d79f7e064cbd5"></script>
</body>

</html>
<?php /**PATH /home/marsisla/public_html/resources/views/layouts/frontend.blade.php ENDPATH**/ ?>