<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('admin.includes.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            Edit portfolio item: <?php echo e($pfpost->title); ?>

        </div>

        <div class="panel-body">
            <form action="<?php echo e(route('pfpost.update', ['id' => $pfpost->id])); ?>" method="post" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" value="<?php echo e($pfpost->title); ?>">
                </div>

                <div class="form-group">
                    <label for="project_title">Project Title (opional)</label>
                    <input type="text" name="project_title" class="form-control" value="<?php echo e($pfpost->project_title); ?>">
                </div>

                <div class="form-group">
                    <label for="completed_at">Completed at</label>
                    <input type="text" name="completed_at" class="form-control" value="<?php echo e($pfpost->completed_at); ?>">
                </div>

                <div class="form-group">
                    <label for="skills">Skills</label>
                    <input type="text" name="skills" class="form-control" value="<?php echo e($pfpost->skills); ?>">
                </div>

                <div class="form-group">
                    <label for="completed_at">Client</label>
                    <input type="text" name="client" class="form-control" value="<?php echo e($pfpost->client); ?>">
                </div>

                <div class="form-group">
                    <label for="client_url">Client URL</label>
                    <input type="text" name="client_url" class="form-control" value="<?php echo e($pfpost->client_url); ?>">
                </div>

                <div class="form-group">
                    <label for="featured">Featured image</label>
                    <input type="file" name="featured" class="form-control">
                </div>
                <div class="form-group">
                    <label for="category">Select a portfolio category</label>
                    <select name="pfcategory_id" id="pfcategory" class="form-control">
                        <?php $__currentLoopData = $pfcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pfcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($pfcategory->id); ?>"
                                    <?php if($pfpost->pfcategory->id == $pfcategory->id): ?>
                                    selected
                                <?php endif; ?>
                            ><?php echo e($pfcategory->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" cols="5" rows="5" class="form-control"><?php echo e($pfpost->content); ?></textarea>
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">
                            Update portfolio item
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        $('#content').summernote({ height: 300 });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/marsisla/public_html/resources/views/admin/pfposts/edit.blade.php ENDPATH**/ ?>