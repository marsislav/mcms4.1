<?php

namespace App\Models; // Update the namespace for Laravel 8

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'content', 'category_id', 'featured', 'slug', 'user_id'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Accessor to get the featured attribute with a full URL.
     *
     * @param  string  $featured
     * @return string
     */
    public function getFeaturedAttribute($featured)
    {
        return asset($featured);
    }

    /**
     * Get the category that owns the post.
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category'); // Update the namespace for the related model
    }

    /**
     * The tags that belong to the post.
     */
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag'); // Update the namespace for the related model
    }

    /**
     * Get the user that owns the post.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User'); // Update the namespace for the related model
    }
}
