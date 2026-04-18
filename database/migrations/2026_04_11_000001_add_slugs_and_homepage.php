<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AddSlugsAndHomepage extends Migration
{
    public function up()
    {
        // Add slug to pfcategories (only if missing)
        if (!Schema::hasColumn('pfcategories', 'slug')) {
            Schema::table('pfcategories', function (Blueprint $table) {
                $table->string('slug')->nullable()->after('name');
            });
        }

        // Add slug to categories (only if missing)
        if (!Schema::hasColumn('categories', 'slug')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->string('slug')->nullable()->after('name');
            });
        }

        // Add slug to tags (only if missing)
        if (!Schema::hasColumn('tags', 'slug')) {
            Schema::table('tags', function (Blueprint $table) {
                $table->string('slug')->nullable()->after('tag');
            });
        }

        // Add slug to pages (only if missing)
        if (!Schema::hasColumn('pages', 'slug')) {
            Schema::table('pages', function (Blueprint $table) {
                $table->string('slug')->nullable()->after('name');
            });
        }

        // Add homepage fields to settings (only if missing)
        if (!Schema::hasColumn('settings', 'homepage_type')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->string('homepage_type')->default('posts')->after('site_name');
            });
        }
        if (!Schema::hasColumn('settings', 'homepage_id')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->unsignedBigInteger('homepage_id')->nullable()->after('homepage_type');
            });
        }

        // Backfill slugs for any rows that don't have one yet
        foreach (\DB::table('pfcategories')->whereNull('slug')->orWhere('slug', '')->get() as $row) {
            \DB::table('pfcategories')->where('id', $row->id)
                ->update(['slug' => Str::slug($row->name) ?: 'pfcategory-' . $row->id]);
        }
        foreach (\DB::table('categories')->whereNull('slug')->orWhere('slug', '')->get() as $row) {
            \DB::table('categories')->where('id', $row->id)
                ->update(['slug' => Str::slug($row->name) ?: 'category-' . $row->id]);
        }
        foreach (\DB::table('tags')->whereNull('slug')->orWhere('slug', '')->get() as $row) {
            \DB::table('tags')->where('id', $row->id)
                ->update(['slug' => Str::slug($row->tag) ?: 'tag-' . $row->id]);
        }
        foreach (\DB::table('pages')->whereNull('slug')->orWhere('slug', '')->get() as $row) {
            \DB::table('pages')->where('id', $row->id)
                ->update(['slug' => Str::slug($row->name) ?: 'page-' . $row->id]);
        }
    }

    public function down()
    {
        if (Schema::hasColumn('pfcategories', 'slug')) {
            Schema::table('pfcategories', fn($t) => $t->dropColumn('slug'));
        }
        if (Schema::hasColumn('categories', 'slug')) {
            Schema::table('categories', fn($t) => $t->dropColumn('slug'));
        }
        if (Schema::hasColumn('tags', 'slug')) {
            Schema::table('tags', fn($t) => $t->dropColumn('slug'));
        }
        if (Schema::hasColumn('pages', 'slug')) {
            Schema::table('pages', fn($t) => $t->dropColumn('slug'));
        }
        if (Schema::hasColumn('settings', 'homepage_type')) {
            Schema::table('settings', fn($t) => $t->dropColumn('homepage_type'));
        }
        if (Schema::hasColumn('settings', 'homepage_id')) {
            Schema::table('settings', fn($t) => $t->dropColumn('homepage_id'));
        }
    }
}
