<?php

namespace App\Models; // Update the namespace for Laravel 8

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'name', 'position', 'content'
    ];

    // Uncomment and update the following relationship if needed
    /*
    public function posts()
    {
        return $this->hasMany('App\Models\Post'); // Update the namespace for the related model
    }
    */
}
