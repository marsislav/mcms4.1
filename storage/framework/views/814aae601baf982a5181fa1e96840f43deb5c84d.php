<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('admin.includes.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            Edit blog settings
        </div>

        <div class="panel-body">
            <form action="<?php echo e(route('settings.update')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('POST'); ?>

                <div class="form-group">
                    <label for="logo">Logo</label>
                    <input type="file" class="form-control" id="logo" name="logo">

                    <?php if($settings->logo): ?>
                        <div class="mt-2">
                            <img src="<?php echo e(asset($settings->logo)); ?>" alt="Current Logo" style="width: 100px; height: auto;">
                            <button type="submit" name="action" value="remove_logo" class="btn btn-danger mt-2">Remove Logo</button>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="name">Site name</label>
                    <input type="text" name="site_name" value="<?php echo e($settings->site_name); ?>" class="form-control">
                </div>

                <div class="form-group">
                    <label for="site_info">About site:</label>
                    <textarea name="site_info" id="site_info" cols="30" rows="10" class="form-control"><?php echo e($settings->site_info); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="facebook">Facebook</label>
                    <input type="text" name="facebook" class="form-control" value="<?php echo e($settings->facebook); ?>">
                </div>

                <div class="form-group">
                    <label for="instagram">Instagram</label>
                    <input type="text" name="instagram" class="form-control" value="<?php echo e($settings->instagram); ?>">
                </div>

                <div class="form-group">
                    <label for="twitter">Twitter</label>
                    <input type="text" name="twitter" class="form-control" value="<?php echo e($settings->twitter); ?>">
                </div>

                <div class="form-group">
                    <label for="tiktok">TikTok</label>
                    <input type="text" name="tiktok" class="form-control" value="<?php echo e($settings->tiktok); ?>">
                </div>

                <div class="form-group">
                    <label for="linkedin">LinkedIn</label>
                    <input type="text" name="linkedin" class="form-control" value="<?php echo e($settings->linkedin); ?>">
                </div>

                <div class="form-group">
                    <label for="vkontakte">VKontakte</label>
                    <input type="text" name="vkontakte" class="form-control" value="<?php echo e($settings->vkontakte); ?>">
                </div>

                <div class="form-group">
                    <label for="youtube">Youtube</label>
                    <input type="text" name="youtube" class="form-control" value="<?php echo e($settings->youtube); ?>">
                </div>

                <div class="form-group">
                    <label for="skype">Skype</label>
                    <input type="text" name="skype" class="form-control" value="<?php echo e($settings->skype); ?>">
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" class="form-control" value="<?php echo e($settings->address); ?>">
                </div>

                <div class="form-group">
                    <label for="contact_number">Contact phone</label>
                    <input type="text" name="contact_number" class="form-control" value="<?php echo e($settings->contact_number); ?>">
                </div>

                <div class="form-group">
                    <label for="contact_email">Contact email</label>
                    <input type="text" name="contact_email" class="form-control" value="<?php echo e($settings->contact_email); ?>">
                </div>

                <div class="form-group">
                    <label for="footer_text1">Footer text: Column: 1</label>
                    <input type="text" name="footer_text1" class="form-control" value="<?php echo e($settings->footer_text1); ?>">
                </div>

                <div class="form-group">
                    <label for="footer_text2">Footer text: Column: 2</label>
                    <input type="text" name="footer_text2" class="form-control" value="<?php echo e($settings->footer_text2); ?>">
                </div>

                <div class="form-group">
                    <label for="footer_text3">Footer text: Column: 3</label>
                    <input type="text" name="footer_text3" class="form-control" value="<?php echo e($settings->footer_text3); ?>">
                </div>

                
                <hr>
                <h5 style="margin-bottom:15px;">🏠 Homepage Settings</h5>

                <div class="form-group">
                    <label>Homepage displays</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="homepage_type" value="posts"
                                <?php echo e(($settings->homepage_type ?? 'posts') === 'posts' ? 'checked' : ''); ?>>
                            Latest Posts (default blog feed)
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="homepage_type" value="page"
                                <?php echo e(($settings->homepage_type ?? '') === 'page' ? 'checked' : ''); ?>>
                            A static page
                        </label>
                    </div>
                </div>

                <div class="form-group" id="homepage-page-select"
                     style="<?php echo e(($settings->homepage_type ?? 'posts') === 'page' ? '' : 'display:none;'); ?>">
                    <label>Select homepage page</label>
                    <select name="homepage_id" class="form-control">
                        <option value="">— choose a page —</option>
                        <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($page->id); ?>"
                                <?php echo e(($settings->homepage_id ?? null) == $page->id ? 'selected' : ''); ?>>
                                <?php echo e($page->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>


                <hr>
                <h5 style="margin-bottom:15px;">📧 Email / SMTP Settings</h5>
                <p class="text-muted small">Used for password reset emails. Configure with your email provider (Gmail, Mailgun, etc.)</p>

                <div class="form-group">
                    <label>SMTP Host</label>
                    <input type="text" name="mail_host" class="form-control" value="<?php echo e($settings->mail_host ?? 'smtp.gmail.com'); ?>" placeholder="smtp.gmail.com">
                </div>
                <div class="form-group">
                    <label>SMTP Port</label>
                    <input type="text" name="mail_port" class="form-control" value="<?php echo e($settings->mail_port ?? '587'); ?>" placeholder="587">
                </div>
                <div class="form-group">
                    <label>SMTP Username (your email)</label>
                    <input type="text" name="mail_username" class="form-control" value="<?php echo e($settings->mail_username ?? ''); ?>" placeholder="yourname@gmail.com">
                </div>
                <div class="form-group">
                    <label>SMTP Password</label>
                    <input type="password" name="mail_password" class="form-control" value="<?php echo e($settings->mail_password ?? ''); ?>" placeholder="App password or SMTP password">
                </div>
                <div class="form-group">
                    <label>Encryption</label>
                    <select name="mail_encryption" class="form-control">
                        <option value="tls" <?php echo e(($settings->mail_encryption ?? 'tls') === 'tls' ? 'selected' : ''); ?>>TLS (port 587)</option>
                        <option value="ssl" <?php echo e(($settings->mail_encryption ?? '') === 'ssl' ? 'selected' : ''); ?>>SSL (port 465)</option>
                        <option value="" <?php echo e(($settings->mail_encryption ?? 'tls') === '' ? 'selected' : ''); ?>>None</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>From Address</label>
                    <input type="email" name="mail_from_address" class="form-control" value="<?php echo e($settings->mail_from_address ?? ''); ?>" placeholder="no-reply@yoursite.com">
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit" name="action" value="update_settings">
                            Update site settings
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
// Show/hide static page selector based on radio choice
document.querySelectorAll('input[name="homepage_type"]').forEach(function(radio) {
    radio.addEventListener('change', function() {
        var sel = document.getElementById('homepage-page-select');
        sel.style.display = this.value === 'page' ? '' : 'none';
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/marsisla/public_html/resources/views/admin/settings/settings.blade.php ENDPATH**/ ?>