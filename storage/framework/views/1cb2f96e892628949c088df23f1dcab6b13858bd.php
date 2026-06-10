<?php $__env->startSection('styles'); ?>
<style>
/* ── Drag & Drop Menu Builder ── */
#menu-tree { list-style: none; padding: 0; margin: 0; min-height: 60px; }
#menu-tree li, .children-list li {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 6px;
    margin-bottom: 8px;
    padding: 10px 14px;
    cursor: grab;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: box-shadow .15s;
    user-select: none;
}
#menu-tree li:active, .children-list li:active { cursor: grabbing; box-shadow: 0 4px 16px rgba(0,0,0,.15); }
.sortable-ghost { opacity: .35; background: #e8f4fd !important; }
.drag-handle { color: #aaa; margin-right: 10px; font-size: 1.2em; cursor: grab; }
.item-label { font-weight: 500; flex: 1; }
.item-type-badge {
    font-size: .7rem; padding: 2px 8px; border-radius: 20px;
    background: #e9ecef; color: #555; margin: 0 8px;
}
.children-list {
    list-style: none;
    padding-left: 36px;
    margin-top: 8px;
}
.children-list li { background: #f8f9fa; }
.btn-del { color: #dc3545; background: none; border: none; cursor: pointer; font-size: 1.1em; padding: 0 4px; }
.btn-del:hover { color: #a71d2a; }
.save-bar {
    position: sticky; bottom: 0;
    background: #fff; border-top: 1px solid #ddd;
    padding: 12px 0; margin-top: 20px; text-align: center;
    z-index: 100;
}
#save-status { margin-left: 12px; font-size: .9em; color: #28a745; display: none; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('admin.includes.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">🧭 Menu Builder</h4>
    <small class="text-muted">Drag items to reorder. Drop onto another item to make it a sub-item.</small>
</div>

<div class="row">
    
    <div class="col-md-7">
        <div class="panel panel-default">
            <div class="panel-heading"><strong>Menu structure</strong></div>
            <div class="panel-body">
                <?php if($items->isEmpty()): ?>
                    <p class="text-muted text-center">No menu items yet. Add some from the right →</p>
                <?php endif; ?>

                <ul id="menu-tree">
                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li data-id="<?php echo e($item->id); ?>" data-parent="">
                            <span class="drag-handle">⠿</span>
                            <span class="item-label"><?php echo e($item->label); ?></span>
                            <span class="item-type-badge"><?php echo e($item->type); ?></span>
                            <form action="<?php echo e(route('menu.delete', $item->id)); ?>" method="GET" style="display:inline;"
                                  onsubmit="return confirm('Delete <?php echo e(addslashes($item->label)); ?>?');">
                                <button class="btn-del" title="Delete">✕</button>
                            </form>

                            <?php if($item->children->count()): ?>
                                <ul class="children-list" style="width:100%; margin-top:8px;">
                                    <?php $__currentLoopData = $item->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li data-id="<?php echo e($child->id); ?>" data-parent="<?php echo e($item->id); ?>">
                                            <span class="drag-handle">⠿</span>
                                            <span class="item-label">↳ <?php echo e($child->label); ?></span>
                                            <span class="item-type-badge"><?php echo e($child->type); ?></span>
                                            <form action="<?php echo e(route('menu.delete', $child->id)); ?>" method="GET" style="display:inline;"
                                                  onsubmit="return confirm('Delete <?php echo e(addslashes($child->label)); ?>?');">
                                                <button class="btn-del" title="Delete">✕</button>
                                            </form>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>

                <div class="save-bar">
                    <button id="save-order-btn" class="btn btn-primary">💾 Save Menu Order</button>
                    <span id="save-status">✓ Saved!</span>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-md-5">
        <div class="panel panel-default">
            <div class="panel-heading"><strong>Add menu item</strong></div>
            <div class="panel-body">
                <form action="<?php echo e(route('menu.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="form-group">
                        <label>Label (text shown in menu)</label>
                        <input type="text" name="label" class="form-control" placeholder="e.g. Blog, About Us" required>
                    </div>

                    <div class="form-group">
                        <label>Type</label>
                        <select name="type" id="item-type" class="form-control">
                            <option value="blog">🏠 Blog (homepage / latest posts)</option>
                            <option value="page">📄 Page</option>
                            <option value="category">📂 Category</option>
                            <option value="pf_category">🖼 Portfolio Category</option>
                            <option value="post">📝 Post</option>
                            <option value="custom">🔗 Custom URL</option>
                        </select>
                    </div>

                    
                    <div class="form-group type-extra" id="extra-page">
                        <label>Select Page</label>
                        <select name="reference_id_page" id="reference_id_page" class="form-control ref-select">
                            <option value="">— choose —</option>
                            <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($page->id); ?>"><?php echo e($page->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                    <div class="form-group type-extra" id="extra-category" style="display:none;">
                        <label>Select Category</label>
                        <select name="reference_id_category" id="reference_id_category" class="form-control ref-select">
                            <option value="">— choose —</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                    <div class="form-group type-extra" id="extra-pf_category" style="display:none;">
                        <label>Select Portfolio Category</label>
                        <select name="reference_id_pf_category" id="reference_id_pf_category" class="form-control ref-select">
                            <option value="">— choose —</option>
                            <?php $__currentLoopData = $pfCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pfCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($pfCat->id); ?>"><?php echo e($pfCat->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                    <div class="form-group type-extra" id="extra-post" style="display:none;">
                        <label>Select Post</label>
                        <select name="reference_id_post" id="reference_id_post" class="form-control ref-select">
                            <option value="">— choose —</option>
                            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($post->id); ?>"><?php echo e($post->title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                    <div class="form-group type-extra" id="extra-custom" style="display:none;">
                        <label>URL</label>
                        <input type="text" name="url" class="form-control" placeholder="https://...">
                    </div>

                    
                    <div class="form-group">
                        <label>Parent item <small class="text-muted">(optional — makes it a dropdown child)</small></label>
                        <select name="parent_id" class="form-control">
                            <option value="">— top level —</option>
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->label); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                    <input type="hidden" name="reference_id" id="reference_id_hidden">
                    <button type="submit" class="btn btn-success btn-block">+ Add to Menu</button>
                </form>
            </div>
        </div>

        
        <div class="panel panel-default">
            <div class="panel-heading"><strong>👁 Live Preview</strong></div>
            <div class="panel-body" style="padding: 10px 16px;">
                <nav style="background:#2d3748; border-radius:6px; padding: 10px 16px;">
                    <ul style="list-style:none; margin:0; padding:0; display:flex; gap:20px; flex-wrap:wrap;" id="menu-preview">
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li style="position:relative;">
                                <a href="#" style="color:#fff; text-decoration:none; font-size:.9em;">
                                    <?php echo e($item->label); ?>

                                    <?php if($item->children->count()): ?> ▾ <?php endif; ?>
                                </a>
                                <?php if($item->children->count()): ?>
                                    <ul style="display:none; position:absolute; top:100%; left:0; background:#fff; border:1px solid #ddd; border-radius:4px; padding:6px 0; min-width:140px; z-index:99; list-style:none;">
                                        <?php $__currentLoopData = $item->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><a href="#" style="display:block; padding:5px 14px; font-size:.85em; color:#333; text-decoration:none;"><?php echo e($child->label); ?></a></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.2/Sortable.min.js"></script>
<script>
// ── Type selector: show/hide relevant field ──────────────────────────────────
const typeMap = {
    page:        'extra-page',
    category:    'extra-category',
    pf_category: 'extra-pf_category',
    post:        'extra-post',
    custom:      'extra-custom'
};

const refSelectMap = {
    page:        'reference_id_page',
    category:    'reference_id_category',
    pf_category: 'reference_id_pf_category',
    post:        'reference_id_post'
};

function syncReferenceId(type) {
    const hidden = document.getElementById('reference_id_hidden');
    if (refSelectMap[type]) {
        const sel = document.getElementById(refSelectMap[type]);
        hidden.value = sel ? sel.value : '';
        if (sel) {
            sel.onchange = function() { hidden.value = this.value; };
        }
    } else {
        hidden.value = '';
    }
}

document.getElementById('item-type').addEventListener('change', function () {
    document.querySelectorAll('.type-extra').forEach(el => el.style.display = 'none');
    if (typeMap[this.value]) document.getElementById(typeMap[this.value]).style.display = '';
    syncReferenceId(this.value);
});

// Init: show page selector by default and sync hidden field
document.getElementById('extra-page').style.display = '';
syncReferenceId('page');

// ── SortableJS on main list ──────────────────────────────────────────────────
const tree = document.getElementById('menu-tree');
if (tree) {
    new Sortable(tree, {
        handle: '.drag-handle',
        animation: 150,
        ghostClass: 'sortable-ghost',
        group: 'menu',
    });

    document.querySelectorAll('.children-list').forEach(ul => {
        new Sortable(ul, {
            handle: '.drag-handle',
            animation: 150,
            ghostClass: 'sortable-ghost',
            group: 'menu',
        });
    });
}

// ── Save order via AJAX ──────────────────────────────────────────────────────
document.getElementById('save-order-btn').addEventListener('click', function () {
    const items = [];
    let sort = 0;

    document.querySelectorAll('#menu-tree > li').forEach(function (li) {
        items.push({ id: li.dataset.id, parent_id: null, sort_order: sort++ });

        let childSort = 0;
        li.querySelectorAll('.children-list > li').forEach(function (child) {
            items.push({ id: child.dataset.id, parent_id: li.dataset.id, sort_order: childSort++ });
        });
    });

    fetch('<?php echo e(route('menu.save.order')); ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
        },
        body: JSON.stringify({ items })
    })
    .then(r => r.json())
    .then(data => {
        if (data.ok) {
            const status = document.getElementById('save-status');
            status.style.display = 'inline';
            setTimeout(() => status.style.display = 'none', 2500);
        }
    });
});

// ── Preview dropdown hover ───────────────────────────────────────────────────
document.querySelectorAll('#menu-preview > li').forEach(function (li) {
    const sub = li.querySelector('ul');
    if (!sub) return;
    li.addEventListener('mouseenter', () => sub.style.display = 'block');
    li.addEventListener('mouseleave', () => sub.style.display = 'none');
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/marsisla/public_html/resources/views/admin/menu/index.blade.php ENDPATH**/ ?>