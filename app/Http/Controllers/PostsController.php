<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session; // Correct namespace
use Illuminate\Support\Str; // Import Str facade
use App\Models\Post; // Update to use App\Models namespace
use App\Models\Category; // Update to use App\Models namespace
use App\Models\Tag; // Update to use App\Models namespace

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'featured' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'required|array'
        ]);

        $featured = $request->file('featured');
        $featured_new_name = time() . '_' . $featured->getClientOriginalName();
        $featured->move(public_path('uploads/posts'), $featured_new_name);

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'featured' => 'uploads/posts/' . $featured_new_name,
            'category_id' => $request->category_id,
            'slug' => Str::slug($request->title), // Use Str::slug
            'user_id' => Auth::id()
        ]);

        $post->tags()->attach($request->tags);

        Session::flash('success', 'Post created successfully.');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Implement if needed
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'required|array'
        ]);

        $post = Post::findOrFail($id);

        if ($request->hasFile('featured')) {
            $featured = $request->file('featured');
            $featured_new_name = time() . '_' . $featured->getClientOriginalName();
            $featured->move(public_path('uploads/posts'), $featured_new_name);
            $post->featured = 'uploads/posts/' . $featured_new_name;
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->save();

        $post->tags()->sync($request->tags);

        Session::flash('success', 'Post updated successfully.');

        return redirect()->route('posts.index'); // Ensure route name matches
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        Session::flash('success', 'The post was just trashed.');

        return redirect()->back();
    }

    /**
     * Display trashed posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $posts = Post::onlyTrashed()->get();
        return view('admin.posts.trashed', compact('posts'));
    }

    /**
     * Permanently delete a trashed post.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function kill($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        $post->forceDelete();

        Session::flash('success', 'Post deleted permanently.');

        return redirect()->back();
    }

    /**
     * Restore a trashed post.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        $post->restore();

        Session::flash('success', 'Post restored successfully.');

        return redirect()->route('posts.index'); // Ensure route name matches
    }
}
