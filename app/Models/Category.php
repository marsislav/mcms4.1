<?php

namespace App\Models; // Make sure the namespace is correct

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Get the posts for the category.
     */

     protected $fillable = [
        'name',
        // Add other attributes that should be mass assignable
    ];

    public function posts()
    {
        return $this->hasMany('App\Models\Post'); // Updated namespace to match Laravel 8 conventions
    }
}