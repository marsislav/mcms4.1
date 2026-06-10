<?php $__env->startSection('content'); ?>

      <?php echo $__env->make('admin.includes.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

      <div class="panel panel-default">
            <div class="panel-heading">
            Update page: <?php echo e($page->name); ?>

            </div>

            <div class="panel-body">
                  <form action="<?php echo e(route('page.update', ['id' => $page->id])); ?>" method="post">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                              <label for="name">Page title</label>
                              <input type="text" name="name" class="form-control" value="<?php echo e($page->name); ?>">

                        </div>
                        <div class="form-group">
                              <label for="position">Navigation position</label>
                              <input type="text" name="position" class="form-control" value="<?php echo e($page->position); ?>">
                              
                        </div>
                        <div class="form-group">
                              <label for="content">Content</label>
                              <textarea name="content" id="content" cols="30" rows="10"><?php echo e($page->content); ?></textarea>
                              
                        </div>
                        <div class="form-group">
                              <div class="text-center">
                                    <button class="btn btn-success" type="submit">
                                          Update page
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/marsisla/public_html/resources/views/admin/pages/edit.blade.php ENDPATH**/ ?>