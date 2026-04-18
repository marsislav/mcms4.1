<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = ['label', 'type', 'reference_id', 'url', 'parent_id', 'sort_order'];

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('sort_order');
    }

    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    /**
     * Resolve the final URL for this menu item.
     */
    public function resolveUrl(): string
    {
        switch ($this->type) {
            case 'page':
                $page = Page::find($this->reference_id);
                return $page ? route('page.single', ['slug' => $page->slug]) : '#';
            case 'category':
                $cat = Category::find($this->reference_id);
                return $cat ? route('category.single', ['slug' => $cat->slug]) : '#';
            case 'post':
                $post = Post::find($this->reference_id);
                return $post ? route('post.single', ['slug' => $post->slug]) : '#';
            case 'blog':
                return url('/');
            case 'custom':
            default:
                return $this->url ?: '#';
        }
    }
}
