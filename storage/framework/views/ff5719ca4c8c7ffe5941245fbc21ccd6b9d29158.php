<?php $__env->startSection('content'); ?>

      <?php echo $__env->make('admin.includes.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

      <div class="panel panel-default">
            <div class="panel-heading">
                  Create a new page
            </div>

            <div class="panel-body">
                  <form action="<?php echo e(route('page.store')); ?>" method="post">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                              <label for="name">Name</label>
                              <input type="text" name="name" class="form-control">

                        </div>
                        <div class="form-group">
                              <label for="position">Navigation position</label>
                              <input type="text" name="position" class="form-control">
                              
                        </div>
                        <div class="form-group">
                              <label for="content">Content</label>
                              <textarea name="content" id="content" cols="30" rows="10"></textarea>
                              
                        </div>
                        <div class="form-group">
                              <div class="text-center">
                                    <button class="btn btn-success" type="submit">
                                          Store page
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/marsisla/public_html/resources/views/admin/pages/create.blade.php ENDPATH**/ ?>