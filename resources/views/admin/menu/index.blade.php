@extends('layouts.app')

@section('styles')
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
@endsection

@section('content')

@include('admin.includes.errors')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">🧭 Menu Builder</h4>
    <small class="text-muted">Drag items to reorder. Drop onto another item to make it a sub-item.</small>
</div>

<div class="row">
    {{-- ── Left: Current menu tree ── --}}
    <div class="col-md-7">
        <div class="panel panel-default">
            <div class="panel-heading"><strong>Menu structure</strong></div>
            <div class="panel-body">
                @if($items->isEmpty())
                    <p class="text-muted text-center">No menu items yet. Add some from the right →</p>
                @endif

                <ul id="menu-tree">
                    @foreach($items as $item)
                        <li data-id="{{ $item->id }}" data-parent="">
                            <span class="drag-handle">⠿</span>
                            <span class="item-label">{{ $item->label }}</span>
                            <span class="item-type-badge">{{ $item->type }}</span>
                            <form action="{{ route('menu.delete', $item->id) }}" method="GET" style="display:inline;"
                                  onsubmit="return confirm('Delete {{ addslashes($item->label) }}?');">
                                <button class="btn-del" title="Delete">✕</button>
                            </form>

                            @if($item->children->count())
                                <ul class="children-list" style="width:100%; margin-top:8px;">
                                    @foreach($item->children as $child)
                                        <li data-id="{{ $child->id }}" data-parent="{{ $item->id }}">
                                            <span class="drag-handle">⠿</span>
                                            <span class="item-label">↳ {{ $child->label }}</span>
                                            <span class="item-type-badge">{{ $child->type }}</span>
                                            <form action="{{ route('menu.delete', $child->id) }}" method="GET" style="display:inline;"
                                                  onsubmit="return confirm('Delete {{ addslashes($child->label) }}?');">
                                                <button class="btn-del" title="Delete">✕</button>
                                            </form>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>

                <div class="save-bar">
                    <button id="save-order-btn" class="btn btn-primary">💾 Save Menu Order</button>
                    <span id="save-status">✓ Saved!</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Right: Add new item ── --}}
    <div class="col-md-5">
        <div class="panel panel-default">
            <div class="panel-heading"><strong>Add menu item</strong></div>
            <div class="panel-body">
                <form action="{{ route('menu.store') }}" method="POST">
                    @csrf

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
                            <option value="post">📝 Post</option>
                            <option value="custom">🔗 Custom URL</option>
                        </select>
                    </div>

                    {{-- Page selector --}}
                    <div class="form-group type-extra" id="extra-page">
                        <label>Select Page</label>
                        {{-- Renamed to reference_id_page to avoid conflict with other selectors --}}
                        <select name="reference_id_page" id="reference_id_page" class="form-control ref-select">
                            <option value="">— choose —</option>
                            @foreach($pages as $page)
                                <option value="{{ $page->id }}">{{ $page->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Category selector --}}
                    <div class="form-group type-extra" id="extra-category" style="display:none;">
                        <label>Select Category</label>
                        {{-- Renamed to reference_id_category to avoid conflict with other selectors --}}
                        <select name="reference_id_category" id="reference_id_category" class="form-control ref-select">
                            <option value="">— choose —</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Post selector --}}
                    <div class="form-group type-extra" id="extra-post" style="display:none;">
                        <label>Select Post</label>
                        {{-- Renamed to reference_id_post to avoid conflict with other selectors --}}
                        <select name="reference_id_post" id="reference_id_post" class="form-control ref-select">
                            <option value="">— choose —</option>
                            @foreach($posts as $post)
                                <option value="{{ $post->id }}">{{ $post->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Custom URL --}}
                    <div class="form-group type-extra" id="extra-custom" style="display:none;">
                        <label>URL</label>
                        <input type="text" name="url" class="form-control" placeholder="https://...">
                    </div>

                    {{-- Parent (submenu) --}}
                    <div class="form-group">
                        <label>Parent item <small class="text-muted">(optional — makes it a dropdown child)</small></label>
                        <select name="parent_id" class="form-control">
                            <option value="">— top level —</option>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}">{{ $item->label }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Hidden field that receives the correct reference_id before submit --}}
                    <input type="hidden" name="reference_id" id="reference_id_hidden">
                    <button type="submit" class="btn btn-success btn-block">+ Add to Menu</button>
                </form>
            </div>
        </div>

        {{-- Preview --}}
        <div class="panel panel-default">
            <div class="panel-heading"><strong>👁 Live Preview</strong></div>
            <div class="panel-body" style="padding: 10px 16px;">
                <nav style="background:#2d3748; border-radius:6px; padding: 10px 16px;">
                    <ul style="list-style:none; margin:0; padding:0; display:flex; gap:20px; flex-wrap:wrap;" id="menu-preview">
                        @foreach($items as $item)
                            <li style="position:relative;">
                                <a href="#" style="color:#fff; text-decoration:none; font-size:.9em;">
                                    {{ $item->label }}
                                    @if($item->children->count()) ▾ @endif
                                </a>
                                @if($item->children->count())
                                    <ul style="display:none; position:absolute; top:100%; left:0; background:#fff; border:1px solid #ddd; border-radius:4px; padding:6px 0; min-width:140px; z-index:99; list-style:none;">
                                        @foreach($item->children as $child)
                                            <li><a href="#" style="display:block; padding:5px 14px; font-size:.85em; color:#333; text-decoration:none;">{{ $child->label }}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
{{-- SortableJS from CDN --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.2/Sortable.min.js"></script>
<script>
// ── Type selector: show/hide relevant field ──────────────────────────────────
// Map type value to the div id that should be shown
const typeMap = { page: 'extra-page', category: 'extra-category', post: 'extra-post', custom: 'extra-custom' };

// Map type value to the corresponding select id for reference_id
const refSelectMap = { page: 'reference_id_page', category: 'reference_id_category', post: 'reference_id_post' };

/**
 * Updates the hidden reference_id field based on currently visible selector.
 * This ensures only one reference_id value is submitted.
 */
function syncReferenceId(type) {
    const hidden = document.getElementById('reference_id_hidden');
    if (refSelectMap[type]) {
        const sel = document.getElementById(refSelectMap[type]);
        hidden.value = sel ? sel.value : '';
        // Also update when the select changes
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

    // Also make child lists sortable
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

        // Children
        let childSort = 0;
        li.querySelectorAll('.children-list > li').forEach(function (child) {
            items.push({ id: child.dataset.id, parent_id: li.dataset.id, sort_order: childSort++ });
        });
    });

    fetch('{{ route('menu.save.order') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
@endsection
