<?php

namespace App\Models; // Update the namespace for Laravel 8

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PfPost extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'content', 'pfcategory_id', 'featured', 'slug', 'client', 'completed_at', 'skills',
        'client_url', 'project_title'
    ];

    protected $dates = [
        'deleted_at', 'completed_at' // Include 'completed_at' if you want it to be treated as a date
    ];

    /**
     * Get the category that owns the PfPost.
     */
    public function pfcategory()
    {
        return $this->belongsTo('App\Models\PfCategory'); // Update the namespace for the related model
    }
}
