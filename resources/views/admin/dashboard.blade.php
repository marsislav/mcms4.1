@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="card text-center mb-3">
                    <div class="card-header">
                        PUBLISHED POSTS
                    </div>
                    <div class="card-body">
                        <h1>{{ $posts_count }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card text-center mb-3">
                    <div class="card-header">
                        TRASHED POSTS
                    </div>
                    <div class="card-body">
                        <h1>{{ $trashed_count }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card text-center mb-3">
                    <div class="card-header">
                        TAGS
                    </div>
                    <div class="card-body">
                        <h1>{{ $tags_count }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card text-center mb-3">
                    <div class="card-header">
                        CATEGORIES
                    </div>
                    <div class="card-body">
                        <h1>{{ $categories_count }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card text-center mb-3">
                    <div class="card-header">
                        PUBLISHED PORTFOLIO ITEMS
                    </div>
                    <div class="card-body">
                        <h1>{{ $pfposts_count }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card text-center mb-3">
                    <div class="card-header">
                        TRASHED PORTFOLIO ITEMS
                    </div>
                    <div class="card-body">
                        <h1>{{ $pftrashed_count }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card text-center mb-3">
                    <div class="card-header">
                        PORTFOLIO CATEGORIES
                    </div>
                    <div class="card-body">
                        <h1>{{ $pfcategories_count }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card text-center mb-3">
                    <div class="card-header">
                        PAGES
                    </div>
                    <div class="card-body">
                        <h1>{{ $pages_count }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card text-center mb-3">
                    <div class="card-header">
                        USERS
                    </div>
                    <div class="card-body">
                        <h1>{{ $users_count }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
