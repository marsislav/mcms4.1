<?php

namespace App\Models; // Update the namespace for Laravel 8

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    // Define the table if it doesn't follow Laravel's default naming convention
    // protected $table = 'profiles';

    // Optional: Define the primary key if it's not the default 'id'
    // protected $primaryKey = 'your_primary_key';

    // Optional: Define whether the model should use timestamps
    // public $timestamps = false;

    // Attributes that are mass assignable
    protected $fillable = [
        'user_id', 'avatar', 'youtube', 'facebook', 'about'
    ];

    /**
     * Get the user that owns the profile.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User'); // Update the namespace for related model
    }
}
