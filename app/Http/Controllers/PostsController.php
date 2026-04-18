<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\ActivityLog;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        if ($categories->isEmpty() || $tags->isEmpty()) {
            Session::flash('info', 'You must have some categories and tags before attempting to create a post.');
            return redirect()->back();
        }

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'featured'    => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content'     => 'required',
            'category_id' => 'required|exists:categories,id',
            'tags'        => 'required|array'
        ]);

        $featured = $request->file('featured');
        $featured_new_name = time() . '_' . $featured->getClientOriginalName();
        $featured->move(public_path('Uploads/posts'), $featured_new_name);

        // Generate unique slug
        $slug = $this->uniqueSlug(Str::slug($request->title), 'posts');

        $post = Post::create([
            'title'       => $request->title,
            'content'     => $request->content,
            'featured'    => 'Uploads/posts/' . $featured_new_name,
            'category_id' => $request->category_id,
            'slug'        => $slug,
            'user_id'     => Auth::id()
        ]);

        $post->tags()->attach($request->tags);

        ActivityLog::log('created post', $request->title, '📝');

        Session::flash('success', 'Post created successfully.');

        return redirect()->back();
    }

    public function edit($id)
    {
        $post       = Post::findOrFail($id);
        $categories = Category::all();
        $tags       = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required',
            'category_id' => 'required|exists:categories,id',
            'tags'        => 'required|array'
        ]);

        $post = Post::findOrFail($id);

        if ($request->hasFile('featured')) {
            $featured          = $request->file('featured');
            $featured_new_name = time() . '_' . $featured->getClientOriginalName();
            $featured->move(public_path('Uploads/posts'), $featured_new_name);
            $post->featured = 'Uploads/posts/' . $featured_new_name;
        }

        $post->title       = $request->title;
        $post->content     = $request->content;
        $post->category_id = $request->category_id;
        $post->save();

        $post->tags()->sync($request->tags);

        ActivityLog::log('updated post', $request->title, '✏️');

        Session::flash('success', 'Post updated successfully.');

        return redirect()->route('posts');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        ActivityLog::log('trashed post', $post->title, '🗑️');
        $post->delete();

        Session::flash('success', 'The post was just trashed.');

        return redirect()->back();
    }

    public function trashed()
    {
        $posts = Post::onlyTrashed()->get();
        return view('admin.posts.trashed', compact('posts'));
    }

    public function kill($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        ActivityLog::log('permanently deleted post', $post->title, '💀');
        $post->forceDelete();

        Session::flash('success', 'Post deleted permanently.');

        return redirect()->back();
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        $post->restore();
        ActivityLog::log('restored post', $post->title, '♻️');

        Session::flash('success', 'Post restored successfully.');

        return redirect()->route('posts');
    }

    /**
     * Generate a unique slug by appending a counter if needed.
     */
    private function uniqueSlug(string $slug, string $table, $ignoreId = null): string
    {
        $original = $slug;
        $count    = 1;
        while (
            \DB::table($table)
                ->where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $original . '-' . $count++;
        }
        return $slug;
    }
}
