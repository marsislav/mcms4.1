

<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-end mb-2">
        <a href="<?php echo e(route('pfcategory.create')); ?>" class="btn btn-success">Add portfolio category</a>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            Portfolio Categories
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <th>
                    Portfolio category name
                </th>
                <th>
                    Editing
                </th>
                <th>
                    Deleting
                </th>
                </thead>

                <tbody>
                <?php if($pfcategories->count() > 0): ?>
                    <?php $__currentLoopData = $pfcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pfcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <?php echo e($pfcategory->name); ?>

                            </td>
                            <td>
                                <a href="<?php echo e(route('pfcategory.edit', ['id' => $pfcategory->id ])); ?>" class="btn btn-xs btn-info">
                                    Edit
                                </a>
                            </td>

                            <td>
                                <a href="<?php echo e(route('pfcategory.delete', ['id' => $pfcategory->id ])); ?>" class="btn btn-xs btn-danger">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <tr>
                        <th colspan="5" class="text-center">No portfolio categories yet.</th>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/marsisla/public_html/resources/views/admin/pfcategories/index.blade.php ENDPATH**/ ?>