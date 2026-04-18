<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Page;
use App\Models\PfPost;
use App\Models\PfCategory;
use App\Models\Tag;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $recent_activity = ActivityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('admin.dashboard')
            ->with('posts_count',       Post::count())
            ->with('pfposts_count',     PfPost::count())
            ->with('trashed_count',     Post::onlyTrashed()->count())
            ->with('pftrashed_count',   PfPost::onlyTrashed()->count())
            ->with('users_count',       User::count())
            ->with('pages_count',       Page::count())
            ->with('categories_count',  Category::count())
            ->with('tags_count',        Tag::count())
            ->with('pfcategories_count',PfCategory::count())
            ->with('recent_activity',   $recent_activity);
    }
}
