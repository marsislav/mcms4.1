@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Published Posts</h4>
    <a href="{{ route('post.create') }}" class="btn btn-success">+ Add Post</a>
</div>

{{-- ✨ EXTRA: Live search --}}
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
                @forelse($posts as $post)
                    <tr class="post-row">
                        <td>
                            <img src="{{ $post->featured }}" alt="{{ $post->title }}"
                                 width="90" height="55" style="object-fit:cover; border-radius:4px;">
                        </td>
                        <td class="post-title align-middle">{{ $post->title }}</td>
                        <td class="align-middle">
                            <a href="{{ route('post.edit', ['id' => $post->id]) }}"
                               class="btn btn-xs btn-info">Edit</a>
                        </td>
                        <td class="align-middle">
                            {{-- ✨ EXTRA: Confirm modal trigger instead of direct link --}}
                            <button type="button" class="btn btn-xs btn-danger btn-trash"
                                    data-id="{{ $post->id }}"
                                    data-title="{{ $post->title }}">
                                Trash
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">No published posts yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- ✨ EXTRA: Confirm Delete Modal --}}
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

@endsection

@section('scripts')
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
            '{{ url('admin/post/delete') }}/' + id;
        $('#confirmTrashModal').modal('show');
    });
});
</script>
@endsection
