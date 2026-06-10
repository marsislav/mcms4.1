<?php $__env->startSection('content'); ?>
    <div class="row">
        
        <div class="col-lg-3 col-md-6">
            <div class="card text-center mb-3 border-primary">
                <div class="card-header bg-primary text-white">📝 POSTS</div>
                <div class="card-body"><h2><?php echo e($posts_count); ?></h2></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card text-center mb-3 border-danger">
                <div class="card-header bg-danger text-white">🗑️ TRASHED</div>
                <div class="card-body"><h2><?php echo e($trashed_count); ?></h2></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card text-center mb-3 border-success">
                <div class="card-header bg-success text-white">🖼️ PORTFOLIO</div>
                <div class="card-body"><h2><?php echo e($pfposts_count); ?></h2></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card text-center mb-3 border-info">
                <div class="card-header bg-info text-white">👥 USERS</div>
                <div class="card-body"><h2><?php echo e($users_count); ?></h2></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card text-center mb-3">
                <div class="card-header">🏷️ TAGS</div>
                <div class="card-body"><h2><?php echo e($tags_count); ?></h2></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card text-center mb-3">
                <div class="card-header">📂 CATEGORIES</div>
                <div class="card-body"><h2><?php echo e($categories_count); ?></h2></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card text-center mb-3">
                <div class="card-header">📄 PAGES</div>
                <div class="card-body"><h2><?php echo e($pages_count); ?></h2></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card text-center mb-3">
                <div class="card-header">🗂️ PF CATEGORIES</div>
                <div class="card-body"><h2><?php echo e($pfcategories_count); ?></h2></div>
            </div>
        </div>
    </div>

    
    <div class="panel panel-default mt-3">
        <div class="panel-heading"><strong>🕒 Recent Activity</strong></div>
        <div class="panel-body" style="padding:0;">
            <?php if($recent_activity->count() > 0): ?>
                <ul class="list-group list-group-flush" id="activity-log">
                    <?php $__currentLoopData = $recent_activity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <span style="font-size:1.2em;"><?php echo e($log->icon); ?></span>
                                <strong><?php echo e($log->user->name ?? 'Unknown'); ?></strong>
                                <?php echo e($log->action); ?>:
                                <em><?php echo e($log->subject); ?></em>
                            </span>
                            <small class="text-muted"><?php echo e($log->created_at->diffForHumans()); ?></small>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php else: ?>
                <p class="text-muted text-center p-3">No activity yet.</p>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/marsisla/public_html/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>