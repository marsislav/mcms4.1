<?php
namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\PfPost;
use App\Models\Page;
use App\Models\Setting;
use App\Models\Category;
use App\Models\PfCategory;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index()
    {
        return view('index')
            ->with('title', Setting::first()->site_name)
            ->with('categories', Category::take(5)->get())
            ->with('pfcategories', PfCategory::take(5)->get())
            ->with('pfposts', PfPost::orderBy('created_at', 'DESC')->paginate(4))
            ->with('tags', Tag::all())
            ->with('pages', Page::orderBy('position', 'asc')->take(5)->get())
            ->with('settings', Setting::first())
            ->with('posts', Post::orderBy('created_at', 'DESC')->paginate(4));
    }

    public function singlePost($slug)
    {
        $post = Post::where('slug', $slug)->first();

        $next_id = Post::where('id', '>', $post->id)->min('id');
        $prev_id = Post::where('id', '<', $post->id)->max('id');

        return view('single')->with('post', $post)
            ->with('title', $post->title)
            ->with('settings', Setting::first())
            ->with('categories', Category::take(5)->get())
            ->with('pages', Page::take(5)->get())
            ->with('next', Post::find($next_id))
            ->with('prev', Post::find($prev_id))
            ->with('tags', Tag::all())
            ->with('posts', Post::orderBy('created_at', 'DESC')->paginate(4));
    }

    public function category($id)
    {
        $category = Category::find($id);

        return view('category')->with('category', $category)
            ->with('title', $category->name)
            ->with('settings', Setting::first())
            ->with('categories', Category::take(5)->get())
            ->with('pages', Page::take(5)->get());
    }

    public function pfcategory($id)
    {
        $pfcategory = PfCategory::find($id);

        return view('pfcategory')->with('pfcategory', $pfcategory)
            ->with('title', $pfcategory->name)
            ->with('settings', Setting::first())
            ->with('pfcategories', PfCategory::take(5)->get())
            ->with('pages', Page::take(5)->get());
    }

    public function singlePfPost($slug)
    {
        $pfpost = PfPost::where('slug', $slug)->first();
        $next_id = PfPost::where('id', '>', $pfpost->id)->min('id');
        $prev_id = PfPost::where('id', '<', $pfpost->id)->max('id');

        return view('portfolio')->with('pfpost', $pfpost)
            ->with('title', $pfpost->title)
            ->with('pfcategories', PfCategory::take(5)->get())
            ->with('pfposts', PfPost::orderBy('created_at', 'DESC')->paginate(4))
            ->with('pages', Page::take(5)->get())
            ->with('next', PfPost::find($next_id))
            ->with('prev', PfPost::find($prev_id))
            ->with('settings', Setting::first());
    }

    public function page($id)
    {
        $page = Page::find($id);

        return view('page')->with('page', $page)
            ->with('name', $page->name)
            ->with('settings', Setting::first())
            ->with('pages', Page::take(5)->get());
    }

    public function tag($id)
    {
        $tag = Tag::find($id);

        return view('tag')->with('tag', $tag)
            ->with('title', $tag->tag)
            ->with('settings', Setting::first())
            ->with('categories', Category::take(5)->get())
            ->with('pages', Page::take(5)->get());
    }
}
