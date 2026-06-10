<?php $__env->startSection('content'); ?>

<?php echo $__env->make('admin.includes.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="panel panel-default">
    <div class="panel-heading">👤 Edit Your Profile</div>
    <div class="panel-body">
        <form action="<?php echo e(route('user.profile.update')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="name" value="<?php echo e($user->name ?? ''); ?>" class="form-control">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo e($user->email ?? ''); ?>" class="form-control">
            </div>

            <hr>
            <p class="text-muted"><small>Leave password fields empty to keep your current password.</small></p>

            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="password" class="form-control" autocomplete="new-password">
            </div>

            
            <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
            </div>

            <hr>

            <div class="form-group">
                <label>Upload New Avatar</label>
                <?php if(!empty($user->profile->avatar)): ?>
                    <div class="mb-2">
                        <img src="<?php echo e(asset($user->profile->avatar)); ?>" width="70" height="70"
                             style="border-radius:50%; object-fit:cover;">
                    </div>
                <?php endif; ?>
                <input type="file" name="avatar" class="form-control">
            </div>

            <div class="form-group">
                <label>Facebook Profile URL</label>
                <input type="text" name="facebook" value="<?php echo e($user->profile->facebook ?? ''); ?>" class="form-control">
            </div>

            <div class="form-group">
                <label>YouTube Profile URL</label>
                <input type="text" name="youtube" value="<?php echo e($user->profile->youtube ?? ''); ?>" class="form-control">
            </div>

            <div class="form-group">
                <label>About You</label>
                <textarea name="about" rows="6" class="form-control"><?php echo e($user->profile->about ?? ''); ?></textarea>
            </div>

            <div class="form-group text-center">
                <button class="btn btn-success" type="submit">Update Profile</button>
            </div>
        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/marsisla/public_html/resources/views/admin/users/profile.blade.php ENDPATH**/ ?>