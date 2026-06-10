

<?php $__env->startSection('content'); ?>

      <div class="stunning-header stunning-header-bg-lightviolet">
            <div class="stunning-header-content">
                  <h1 class="stunning-header-title">Резултат от търсенето: <?php echo e($query); ?></h1>
            </div>
      </div>

      <div class="container">
            <div class="row medium-padding120">
                  <main class="main">
                              
                              <div class="row">
                                          <?php if($posts->count() > 0): ?>
                                                <div class="case-item-wrap">
                                                      <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            
                                                            <div class="col-lg-4  col-md-4 col-sm-6 col-xs-12">
                                                                  <div class="case-item">
                                                                        <div class="case-item__thumb mouseover poster-3d lightbox shadow animation-disabled" data-offset="5">
                                                                        <img src="<?php echo e($post->featured); ?>" alt="our case">
                                                                        </div>
                                                                        <a href="<?php echo e(route('post.single', ['slug' => $post->slug ])); ?>"><h6 class="case-item__title"><?php echo e($post->title); ?></h6></a>
                                                                  </div>
                                                            </div>

                                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                          <?php else: ?>
                                                <h1 class="text-center">
                                                      Не са намерени резултати.
                                                </h1>
                                          <?php endif; ?>
                              </div>

                        </main>
            </div>
      </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/marsisla/public_html/resources/views/results.blade.php ENDPATH**/ ?>