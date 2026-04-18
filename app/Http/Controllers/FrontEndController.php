<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\PfPost;
use App\Models\Page;
use App\Models\Setting;
use App\Models\Category;
use App\Models\PfCategory;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    /**
     * Shared data passed to every public view.
     */
    private function shared(): array
    {
        $settings = Setting::first();
        return [
            'settings'   => $settings,
            'categories' => Category::take(5)->get(),
            'pages'      => Page::orderBy('position', 'asc')->take(5)->get(),
            'tags'       => Tag::all(),
            'menuItems'  => MenuItem::whereNull('parent_id')->orderBy('sort_order')->with('children')->get(),
        ];
    }

    /**
     * Homepage — shows "Latest Posts" OR a static page, based on Settings.
     */
    public function index()
    {
        $settings = Setting::first();

        // ✨ Homepage type: static page
        if ($settings && $settings->homepage_type === 'page' && $settings->homepage_id) {
            $page = Page::find($settings->homepage_id);
            if ($page) {
                return view('page', array_merge($this->shared(), [
                    'page'  => $page,
                    'title' => $page->name,
                ]));
            }
        }

        // Default: latest posts feed
        return view('index', array_merge($this->shared(), [
            'title'       => $settings->site_name ?? config('app.name'),
            'pfcategories'=> PfCategory::take(5)->get(),
            'pfposts'     => PfPost::orderBy('created_at', 'DESC')->paginate(4),
            'posts'       => Post::orderBy('created_at', 'DESC')->paginate(4),
        ]));
    }

    public function singlePost($slug)
    {
        $post    = Post::where('slug', $slug)->firstOrFail();
        $next_id = Post::where('id', '>', $post->id)->min('id');
        $prev_id = Post::where('id', '<', $post->id)->max('id');

        return view('single', array_merge($this->shared(), [
            'post'  => $post,
            'title' => $post->title,
            'next'  => Post::find($next_id),
            'prev'  => Post::find($prev_id),
            'posts' => Post::orderBy('created_at', 'DESC')->paginate(4),
        ]));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        return view('category', array_merge($this->shared(), [
            'category' => $category,
            'title'    => $category->name,
        ]));
    }

    public function pfcategory($slug)
    {
        $pfcategory = PfCategory::where('slug', $slug)->firstOrFail();

        return view('pfcategory', array_merge($this->shared(), [
            'pfcategory'   => $pfcategory,
            'title'        => $pfcategory->name,
            'pfcategories' => PfCategory::take(5)->get(),
        ]));
    }

    public function singlePfPost($slug)
    {
        $pfpost  = PfPost::where('slug', $slug)->firstOrFail();
        $next_id = PfPost::where('id', '>', $pfpost->id)->min('id');
        $prev_id = PfPost::where('id', '<', $pfpost->id)->max('id');

        return view('portfolio', array_merge($this->shared(), [
            'pfpost'       => $pfpost,
            'title'        => $pfpost->title,
            'pfcategories' => PfCategory::take(5)->get(),
            'pfposts'      => PfPost::orderBy('created_at', 'DESC')->paginate(4),
            'next'         => PfPost::find($next_id),
            'prev'         => PfPost::find($prev_id),
        ]));
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        return view('page', array_merge($this->shared(), [
            'page'  => $page,
            'title' => $page->name,
        ]));
    }

    public function tag($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();

        return view('tag', array_merge($this->shared(), [
            'tag'   => $tag,
            'title' => $tag->tag,
        ]));
    }
}
