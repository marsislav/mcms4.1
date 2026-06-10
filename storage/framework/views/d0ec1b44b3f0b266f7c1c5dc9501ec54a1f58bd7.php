<?php $__env->startSection('content'); ?>

    <div class="d-flex justify-content-end mb-2">
        <a href="<?php echo e(route('category.create')); ?>" class="btn btn-success">Add Category</a>
    </div>

    
    <div class="mb-3" style="position:relative; max-width:360px;">
        <div style="position:relative;">
            <input type="text"
                   id="cat-search"
                   class="form-control"
                   placeholder="Търси категория..."
                   autocomplete="off">
            <span id="cat-search-clear"
                  style="display:none; position:absolute; right:10px; top:50%; transform:translateY(-50%);
                         cursor:pointer; color:#999; font-size:18px; line-height:1;"
                  title="Изчисти">&#x2715;</span>
        </div>

        
        <div id="cat-dropdown"
             style="display:none; position:absolute; z-index:9999; width:100%;
                    background:#fff; border:1px solid #ccc; border-top:none;
                    box-shadow:0 4px 10px rgba(0,0,0,.15); max-height:300px; overflow-y:auto;">
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            Categories
        </div>
        <div class="panel-body">
            <table class="table table-hover" id="cat-table">
                <thead>
                    <th>Category name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
                <tbody id="cat-tbody">
                    <?php if($categories->count() > 0): ?>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($category->name); ?></td>
                            <td>
                                <a href="<?php echo e(route('category.edit', ['id' => $category->id])); ?>"
                                   class="btn btn-xs btn-info">Edit</a>
                            </td>
                            <td>
                                <a href="<?php echo e(route('category.delete', ['id' => $category->id])); ?>"
                                   class="btn btn-xs btn-danger"
                                   onclick="return confirm('Изтриване на \'<?php echo e($category->name); ?>\'?')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr><td colspan="3" class="text-center">No categories yet.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<style>
    #cat-dropdown .dd-item {
        padding: 8px 12px;
        cursor: pointer;
        border-bottom: 1px solid #f0f0f0;
        font-size: 14px;
    }
    #cat-dropdown .dd-item:last-child { border-bottom: none; }
    #cat-dropdown .dd-item:hover,
    #cat-dropdown .dd-item.dd-active { background: #f0f7ff; }
    #cat-dropdown .dd-item mark {
        background: transparent;
        font-weight: bold;
        color: #0066cc;
        padding: 0;
    }
    #cat-dropdown .dd-empty {
        padding: 10px 12px;
        color: #999;
        font-style: italic;
        font-size: 13px;
    }
</style>
<script>
(function () {
    var input      = document.getElementById('cat-search');
    var clearBtn   = document.getElementById('cat-search-clear');
    var dropdown   = document.getElementById('cat-dropdown');
    var tbody      = document.getElementById('cat-tbody');
    var searchUrl  = '<?php echo e(route("category.search")); ?>';
    var editBase   = '<?php echo e(url("admin/category/edit")); ?>';
    var deleteBase = '<?php echo e(url("admin/category/delete")); ?>';

    var timer, activeIdx = -1, lastResults = [];

    /* ── Input handler ── */
    input.addEventListener('input', function () {
        var q = this.value;
        clearBtn.style.display = q ? 'inline' : 'none';
        activeIdx = -1;
        clearTimeout(timer);
        if (q.trim() === '') { closeDropdown(); filterTable(''); return; }
        timer = setTimeout(function () { fetchResults(q); }, 220);
    });

    /* ── Keyboard navigation ── */
    input.addEventListener('keydown', function (e) {
        var items = dropdown.querySelectorAll('.dd-item');
        if (!items.length) return;

        if (e.key === 'ArrowDown') {
            e.preventDefault();
            activeIdx = Math.min(activeIdx + 1, items.length - 1);
            highlight(items);
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            activeIdx = Math.max(activeIdx - 1, 0);
            highlight(items);
        } else if (e.key === 'Enter' && activeIdx >= 0) {
            e.preventDefault();
            selectItem(lastResults[activeIdx]);
        } else if (e.key === 'Escape') {
            closeDropdown();
        }
    });

    /* ── Clear button ── */
    clearBtn.addEventListener('click', function () {
        input.value = '';
        clearBtn.style.display = 'none';
        closeDropdown();
        filterTable('');
        input.focus();
    });

    /* ── Close on outside click ── */
    document.addEventListener('click', function (e) {
        if (!input.contains(e.target) && !dropdown.contains(e.target)) {
            closeDropdown();
        }
    });

    /* ── Fetch from server ── */
    function fetchResults(q) {
        fetch(searchUrl + '?q=' + encodeURIComponent(q), { headers: { 'Accept': 'application/json' } })
            .then(function (r) { return r.json(); })
            .then(function (data) {
                lastResults = data;
                renderDropdown(data, q);
                filterTable(q);          // едновременно филтрира и таблицата
            })
            .catch(function () {});
    }

    /* ── Dropdown render ── */
    function renderDropdown(items, q) {
        if (!items.length) {
            dropdown.innerHTML = '<div class="dd-empty">Няма намерени категории</div>';
            dropdown.style.display = 'block';
            return;
        }
        dropdown.innerHTML = items.map(function (cat, i) {
            return '<div class="dd-item" data-i="' + i + '">' + highlight_text(esc(cat.name), q) + '</div>';
        }).join('');
        dropdown.style.display = 'block';

        dropdown.querySelectorAll('.dd-item').forEach(function (el) {
            el.addEventListener('mouseenter', function () {
                activeIdx = parseInt(this.getAttribute('data-i'));
                highlight(dropdown.querySelectorAll('.dd-item'));
            });
            el.addEventListener('click', function () {
                selectItem(lastResults[parseInt(this.getAttribute('data-i'))]);
            });
        });
    }

    /* ── Select a dropdown item → scroll table row into view ── */
    function selectItem(cat) {
        input.value = cat.name;
        clearBtn.style.display = 'inline';
        closeDropdown();
        filterTable(cat.name);
    }

    /* ── Highlight active item ── */
    function highlight(items) {
        items.forEach(function (el, i) {
            el.classList.toggle('dd-active', i === activeIdx);
        });
    }

    /* ── Filter the main table ── */
    function filterTable(q) {
        var rows = tbody.querySelectorAll('tr');
        var lower = q.toLowerCase();
        var any = false;
        rows.forEach(function (row) {
            var cell = row.querySelector('td');
            if (!cell) return;
            var match = !lower || cell.textContent.toLowerCase().indexOf(lower) !== -1;
            row.style.display = match ? '' : 'none';
            if (match) any = true;
        });
    }

    /* ── Close dropdown ── */
    function closeDropdown() {
        dropdown.style.display = 'none';
        activeIdx = -1;
    }

    /* ── Bold-highlight match in text ── */
    function highlight_text(str, q) {
        if (!q) return str;
        var re = new RegExp('(' + q.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') + ')', 'gi');
        return str.replace(re, '<mark>$1</mark>');
    }

    function esc(s) {
        return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }
})();
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/marsisla/public_html/resources/views/admin/categories/index.blade.php ENDPATH**/ ?>