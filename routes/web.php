<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\PfPostsController;
use App\Http\Controllers\PfCategoriesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\SettingsController;


//Fixes
Route::get('/pages', [PagesController::class, 'index'])->name('pages.index');
Route::get('/category', [PagesController::class, 'index'])->name('categories.index');
Route::get('/tag', [PagesController::class, 'index'])->name('tags.index');
Route::get('/pfcategory', [PagesController::class, 'index'])->name('pfcategories.index');
Route::get('/user', [PagesController::class, 'index'])->name('users.index');

// Public routes
Route::get('/', [FrontEndController::class, 'index'])->name('index');
Route::get('/login', [FrontEndController::class, 'login'])->name('login');
Route::get('/register', [FrontEndController::class, 'register'])->name('register');

Route::post('/logout', [UsersController::class, 'logout'])->name('logout');

Route::get('/results', function() {
    $posts = \App\Models\Post::where('title', 'like', '%' . request('query') . '%')->get();
    return view('results', [
        'posts' => $posts,
        'title' => 'Search results: ' . request('query'),
        'settings' => \App\Models\Setting::first(),
        'categories' => \App\Models\Category::take(5)->get(),
        'pages' => \App\Models\Page::take(5)->get(),
        'query' => request('query'),
    ]);
});

Route::get('/post/{slug}', [FrontEndController::class, 'singlePost'])->name('post.single');
Route::get('/portfolio-item/{slug}', [FrontEndController::class, 'singlePfPost'])->name('pfpost.single');
Route::get('/category/{id}', [FrontEndController::class, 'category'])->name('category.single');
Route::get('/portfolio/{id}', [FrontEndController::class, 'pfcategory'])->name('pfcategory.single');
Route::get('/page/{id}', [FrontEndController::class, 'page'])->name('page.single');
Route::get('/tag/{id}', [FrontEndController::class, 'tag'])->name('tag.single');

Route::post('/contact/submit', [MessagesController::class, 'submit']);

// Authentication Routes
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Admin routes
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::redirect('/', '/admin/dashboard');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

    // Post Routes
    Route::get('/post/create', [PostsController::class, 'create'])->name('post.create');
    Route::post('/post/store', [PostsController::class, 'store'])->name('post.store');
    Route::get('/post/delete/{id}', [PostsController::class, 'destroy'])->name('post.delete');
    Route::get('/posts', [PostsController::class, 'index'])->name('posts');
    Route::get('/posts/trashed', [PostsController::class, 'trashed'])->name('posts.trashed');
    Route::get('/posts/kill/{id}', [PostsController::class, 'kill'])->name('post.kill');
    Route::get('/posts/restore/{id}', [PostsController::class, 'restore'])->name('post.restore');
    Route::get('/posts/edit/{id}', [PostsController::class, 'edit'])->name('post.edit');
    Route::post('/post/update/{id}', [PostsController::class, 'update'])->name('post.update');

    // Portfolio Routes
    Route::get('/pfpost/create', [PfPostsController::class, 'create'])->name('pfpost.create');
    Route::post('/pfpost/store', [PfPostsController::class, 'store'])->name('pfpost.store');
    Route::get('/pfpost/delete/{id}', [PfPostsController::class, 'destroy'])->name('pfpost.delete');
    Route::get('/pfposts', [PfPostsController::class, 'index'])->name('pfposts');
    Route::get('/pfposts/trashed', [PfPostsController::class, 'trashed'])->name('pfposts.trashed');
    Route::get('/pfposts/kill/{id}', [PfPostsController::class, 'kill'])->name('pfpost.kill');
    Route::get('/pfposts/restore/{id}', [PfPostsController::class, 'restore'])->name('pfpost.restore');
    Route::get('/pfposts/edit/{id}', [PfPostsController::class, 'edit'])->name('pfpost.edit');
    Route::post('/pfpost/update/{id}', [PfPostsController::class, 'update'])->name('pfpost.update');

    // Portfolio Categories Routes
    Route::get('/pfcategory/create', [PfCategoriesController::class, 'create'])->name('pfcategory.create');
    Route::get('/pfcategories', [PfCategoriesController::class, 'index'])->name('pfcategories');
    Route::post('/pfcategory/store', [PfCategoriesController::class, 'store'])->name('pfcategory.store');
    Route::get('/pfcategory/edit/{id}', [PfCategoriesController::class, 'edit'])->name('pfcategory.edit');
    Route::get('/pfcategory/delete/{id}', [PfCategoriesController::class, 'destroy'])->name('pfcategory.delete');
    Route::post('/pfcategory/update/{id}', [PfCategoriesController::class, 'update'])->name('pfcategory.update');

    // Categories Routes
    Route::get('/category/create', [CategoriesController::class, 'create'])->name('category.create');
    Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');
    Route::post('/category/store', [CategoriesController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{id}', [CategoriesController::class, 'edit'])->name('category.edit');
    Route::get('/category/delete/{id}', [CategoriesController::class, 'destroy'])->name('category.delete');
    Route::post('/category/update/{id}', [CategoriesController::class, 'update'])->name('category.update');

    // Pages Routes
    Route::get('/page/create', [PagesController::class, 'create'])->name('page.create');
    Route::get('/page', [PagesController::class, 'index'])->name('pages');
    Route::post('/page/store', [PagesController::class, 'store'])->name('page.store');
    Route::get('/page/edit/{id}', [PagesController::class, 'edit'])->name('page.edit');
    Route::get('/page/delete/{id}', [PagesController::class, 'destroy'])->name('page.delete');
    Route::post('/page/update/{id}', [PagesController::class, 'update'])->name('page.update');

    // Tags Routes
    Route::get('/tags', [TagsController::class, 'index'])->name('tags');
    Route::get('/tag/edit/{id}', [TagsController::class, 'edit'])->name('tag.edit');
    Route::get('/tag/create', [TagsController::class, 'create'])->name('tag.create');
    Route::post('/tag/store', [TagsController::class, 'store'])->name('tag.store');
    Route::post('/tag/update/{id}', [TagsController::class, 'update'])->name('tag.update');
    Route::get('/tag/delete/{id}', [TagsController::class, 'destroy'])->name('tag.delete');

    // Users Routes
    Route::get('/users', [UsersController::class, 'index'])->name('users');
    Route::get('/user/create', [UsersController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UsersController::class, 'store'])->name('user.store');
    Route::get('user/admin/{id}', [UsersController::class, 'admin'])->name('user.admin');
    Route::get('user/not-admin/{id}', [UsersController::class, 'not_admin'])->name('user.not.admin');
    Route::get('user/profile', [ProfilesController::class, 'index'])->name('user.profile');
    Route::get('user/delete/{id}', [UsersController::class, 'destroy'])->name('user.delete');
    Route::post('/user/profile/update', [ProfilesController::class, 'update'])->name('user.profile.update');

    // Settings Routes
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');

    // Messages Routes
    Route::get('/messages', [MessagesController::class, 'getMessages'])->name('get.messages');
});

