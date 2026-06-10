<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">💬 Messages</h4>
    <small class="text-muted"><?php echo e($messages->total()); ?> total</small>
</div>

<?php if($messages->count() > 0): ?>
    <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="panel panel-default">
            <div class="panel-heading d-flex justify-content-between">
                <span>
                    <strong><?php echo e($message->name); ?></strong>
                    &mdash;
                    <a href="mailto:<?php echo e($message->email); ?>"><?php echo e($message->email); ?></a>
                </span>
                <small class="text-muted">
                    <?php echo e($message->created_at->setTimezone('Europe/Sofia')->format('d M Y, H:i')); ?>

                </small>
            </div>
            <div class="panel-body">
                <p class="mb-2"><?php echo e($message->message); ?></p>
                
                <form action="<?php echo e(route('messages.delete', $message->id)); ?>" method="POST"
                      onsubmit="return confirm('Delete this message?');">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-danger btn-xs">🗑 Delete</button>
                </form>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php echo e($messages->links()); ?>

<?php else: ?>
    <p class="text-muted text-center mt-4">No messages yet.</p>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/marsisla/public_html/resources/views/admin/messages.blade.php ENDPATH**/ ?>