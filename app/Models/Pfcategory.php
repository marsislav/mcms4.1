<?php

namespace App\Models; // Update the namespace for Laravel 8

use Illuminate\Database\Eloquent\Model;

class Pfcategory extends Model
{
    /**
     * Get the pfposts for the pfcategory.
     */
    public function pfposts()
    {
        return $this->hasMany('App\Models\PfPost'); // Update the namespace for the related model
    }
}
