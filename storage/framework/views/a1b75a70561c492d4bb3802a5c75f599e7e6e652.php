

<?php $__env->startSection('content'); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            Trashed portfolio items
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
                    Restore
                </th>
                <th>
                    Destroy
                </th>
                </thead>

                <tbody>
                <?php if($pfposts->count() > 0): ?>
                    <?php $__currentLoopData = $pfposts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pfpost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><img src="<?php echo e($pfpost->featured); ?>" alt="<?php echo e($pfpost->title); ?>" width="90px" height="50px"></td>
                            <td><?php echo e($pfpost->title); ?></td>
                            <td>Edit</td>
                            <td>
                                <a href="<?php echo e(route('pfpost.restore', ['id' => $pfpost->id])); ?>" class="btn btn-xs btn-success">Restore</a>
                            </td>
                            <td>
                                <a href="<?php echo e(route('pfpost.kill', ['id' => $pfpost->id])); ?>" class="btn btn-xs btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <tr>
                        <th colspan="5" class="text-center">No trashed portfolio items</th>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/marsisla/public_html/resources/views/admin/pfposts/trashed.blade.php ENDPATH**/ ?>