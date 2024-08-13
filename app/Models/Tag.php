<?php

namespace App\Models; // Update the namespace for Laravel 8

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['tag'];

    /**
     * The posts that belong to the tag.
     */
    public function posts()
    {
        return $this->belongsToMany('App\Models\Post'); // Update the namespace for the related model
    }
}
