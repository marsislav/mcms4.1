<?php
    if (empty($recentPosts)) $recentPosts = \App\Models\Post::orderBy('created_at','DESC')->take(10)->get();
    if (empty($categories))  $categories  = \App\Models\Category::take(5)->get();
    if (empty($tags))        $tags        = \App\Models\Tag::all();
    if (empty($settings))    $settings    = \App\Models\Setting::first();
?>
<div class="col-xl-4 col-lg-5">
    <div class="sidebar-wrapper">
        <!-- Search Form -->
        <div class="sidebar-box search-form-box mb-30">
            <?php echo $__env->make('includes.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        
        <!-- Recent Posts -->
        <div class="sidebar-box recent-blog-box mb-30">
            <h4>Последни публикации</h4>
            <?php $__currentLoopData = $recentPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="recent-blog-items">
                    <div class="recent-blog mb-30">
                        <div class="recent-blog-img">
                            <img src="<?php echo e($post->featured); ?>" alt="<?php echo e($post->title); ?>">
                        </div>
                        <div class="recent-blog-content">
                            <h5>
                                <a href="<?php echo e(route('post.single', ['slug' => $post->slug])); ?>">
                                    <?php echo e($post->title); ?>

                                </a>
                            </h5>
                            <span class="date">
                                <i class="lni lni-calendar"></i> <?php echo e($post->created_at->toFormattedDateString()); ?>

                            </span>
                            <p class="category">
                                <i class="lni lni-folder"></i>
                                <a href="<?php echo e(route('category.single', ['slug' => $post->category->slug])); ?>">
                                    <?php echo e($post->category->name); ?>

                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
        <!-- Categories -->
        <div class="sidebar-box catagories-box mb-30">
            <h4>Категории</h4>
            <ul>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a href="<?php echo e(route('category.single', ['slug' => $category->slug])); ?>">
                            <?php echo e($category->name); ?>

                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        
        <!-- Tags -->
        <div class="sidebar-box tags-box mb-30">
            <h4>Всички етикети</h4>
            <ul>
                <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a href="<?php echo e(route('tag.single', ['slug' => $tag->slug])); ?>">
                            <?php echo e($tag->tag); ?>

                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        
        <!-- Social Media Links -->
        <div class="sidebar-box mb-30">
            <h4>Последвайте ме</h4>
            <div class="footer-social-links">
                <ul class="d-flex justify-content-start">
                    <?php if(!empty($settings->facebook)): ?>
                        <li><a href="<?php echo e($settings->facebook); ?>" target="_blank"><i class="lni lni-facebook-filled"></i></a></li>
                    <?php endif; ?>
                    <?php if(!empty($settings->instagram)): ?>
                        <li><a href="<?php echo e($settings->instagram); ?>" target="_blank"><i class="lni lni-instagram-filled"></i></a></li>
                    <?php endif; ?>
                    <?php if(!empty($settings->twitter)): ?>
                        <li><a href="<?php echo e($settings->twitter); ?>" target="_blank"><i class="lni lni-twitter-filled"></i></a></li>
                    <?php endif; ?>
                    <?php if(!empty($settings->tiktok)): ?>
                        <li><a href="<?php echo e($settings->tiktok); ?>" target="_blank"><i class="lni lni-tiktok"></i></a></li>
                    <?php endif; ?>
                    <?php if(!empty($settings->linkedin)): ?>
                        <li><a href="<?php echo e($settings->linkedin); ?>" target="_blank"><i class="lni lni-linkedin-filled"></i></a></li>
                    <?php endif; ?>
                    <?php if(!empty($settings->vkontakte)): ?>
                        <li><a href="<?php echo e($settings->vkontakte); ?>" target="_blank"><i class="lni lni-vk"></i></a></li>
                    <?php endif; ?>
                    <?php if(!empty($settings->youtube)): ?>
                        <li><a href="<?php echo e($settings->youtube); ?>" target="_blank"><i class="lni lni-youtube"></i></a></li>
                    <?php endif; ?>
                    <?php if(!empty($settings->skype)): ?>
                        <li><a href="<?php echo e($settings->skype); ?>" target="_blank"><i class="lni lni-skype"></i></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div><?php /**PATH /home/marsisla/public_html/resources/views/includes/sidebar.blade.php ENDPATH**/ ?>