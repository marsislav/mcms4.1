<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Published Posts</h4>
    <a href="<?php echo e(route('post.create')); ?>" class="btn btn-success">+ Add Post</a>
</div>


<div id="admin-search-wrap">
    <input type="text" id="post-search" class="form-control"
           placeholder="🔍 Search posts by title...">
</div>

<div class="panel panel-default">
    <div class="panel-body" style="padding:0;">
        <table class="table table-hover mb-0" id="posts-table">
            <thead>
                <tr>
                    <th width="100">Image</th>
                    <th>Title</th>
                    <th width="90">Edit</th>
                    <th width="90">Trash</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="post-row">
                        <td>
                            <img src="<?php echo e($post->featured); ?>" alt="<?php echo e($post->title); ?>"
                                 width="90" height="55" style="object-fit:cover; border-radius:4px;">
                        </td>
                        <td class="post-title align-middle"><?php echo e($post->title); ?></td>
                        <td class="align-middle">
                            <a href="<?php echo e(route('post.edit', ['id' => $post->id])); ?>"
                               class="btn btn-xs btn-info">Edit</a>
                        </td>
                        <td class="align-middle">
                            
                            <button type="button" class="btn btn-xs btn-danger btn-trash"
                                    data-id="<?php echo e($post->id); ?>"
                                    data-title="<?php echo e($post->title); ?>">
                                Trash
                            </button>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted">No published posts yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


<div class="modal fade" id="confirmTrashModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">🗑️ Trash Post?</h5>
            </div>
            <div class="modal-body">
                <p>Move <strong id="modal-post-title"></strong> to trash?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="#" id="modal-confirm-btn" class="btn btn-danger">Yes, Trash it</a>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
// ✨ Live search — filters rows as you type
document.getElementById('post-search').addEventListener('input', function () {
    const query = this.value.toLowerCase();
    document.querySelectorAll('#posts-table .post-row').forEach(function (row) {
        const title = row.querySelector('.post-title').textContent.toLowerCase();
        row.style.display = title.includes(query) ? '' : 'none';
    });
});

// ✨ Confirm modal — wire up trash buttons
document.querySelectorAll('.btn-trash').forEach(function (btn) {
    btn.addEventListener('click', function () {
        const id    = this.dataset.id;
        const title = this.dataset.title;
        document.getElementById('modal-post-title').textContent = title;
        document.getElementById('modal-confirm-btn').href =
            '<?php echo e(url('admin/post/delete')); ?>/' + id;
        $('#confirmTrashModal').modal('show');
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/marsisla/public_html/resources/views/admin/posts/index.blade.php ENDPATH**/ ?>