<header class="header bg-white navbar-area">
    <?php echo $__env->make('includes.contactsInfo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand" href="/">
                        <?php if($settings->logo): ?>
                            <img src="<?php echo e(asset($settings->logo)); ?>" alt="<?php echo e($settings->site_name); ?> Logo">
                        <?php else: ?>
                            <?php echo e($settings->site_name); ?>

                        <?php endif; ?>
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

                            
                            <?php if(isset($menuItems) && $menuItems->count() > 0): ?>
                                <?php $__currentLoopData = $menuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($item->children->count()): ?>
                                        
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="<?php echo e($item->resolveUrl()); ?>"
                                               data-bs-toggle="dropdown" role="button">
                                                <?php echo e($item->label); ?>

                                            </a>
                                            <ul class="dropdown-menu">
                                                <?php $__currentLoopData = $item->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                        <a class="dropdown-item" href="<?php echo e($child->resolveUrl()); ?>">
                                                            <?php echo e($child->label); ?>

                                                        </a>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </li>
                                    <?php else: ?>
                                        
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo e($item->resolveUrl()); ?>">
                                                <?php echo e($item->label); ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                
                                <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo e(route('page.single', ['slug' => $page->slug])); ?>">
                                            <?php echo e($page->name); ?>

                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>

                            <?php if(Auth::check()): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(url('admin')); ?>">Администрация</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(url('admin/user/profile')); ?>">
                                        <?php echo e(Auth::user()->name); ?>

                                    </a>
                                </li>
                                <li class="nav-item">
                                    <form action="<?php echo e(route('logout')); ?>" method="POST" style="display:inline;">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="nav-link btn btn-link"
                                                style="padding:0;border:none;background:none;cursor:pointer;">
                                            Изход
                                        </button>
                                    </form>
                                </li>
                            <?php else: ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(url('/login')); ?>">Вход</a>
                                </li>
                            <?php endif; ?>

                        </ul>

                        <?php echo $__env->make('includes.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<?php /**PATH /home/marsisla/public_html/resources/views/includes/header.blade.php ENDPATH**/ ?>