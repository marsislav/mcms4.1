

<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-end mb-2">
        <a href="<?php echo e(route('pfpost.create')); ?>" class="btn btn-success">Add Portfolio item</a>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Published portfolio items
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <th>
                    Image
                </th>
                <th>
                    Title
                </th>
                <th>
                    Edit
                </th>
                <th>
                    Trash
                </th>
                </thead>

                <tbody>
                <?php if($pfposts->count() > 0): ?>
                    <?php $__currentLoopData = $pfposts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pfpost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><img src="<?php echo e($pfpost->featured); ?>" alt="<?php echo e($pfpost->title); ?>" width="90px" height="50px"></td>
                            <td><?php echo e($pfpost->title); ?></td>
                            <td>
                                <a href="<?php echo e(route('pfpost.edit', ['id' => $pfpost->id])); ?>" class="btn btn-xs btn-info">Edit</a>
                            </td>

                            <td>
                                <a href="<?php echo e(route('pfpost.delete', ['id' => $pfpost->id])); ?>" class="btn btn-xs btn-danger">Trash</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <tr>
                        <th colspan="5" class="text-center">No published portfolio items</th>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/marsisla/public_html/resources/views/admin/pfposts/index.blade.php ENDPATH**/ ?>