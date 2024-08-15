<?php

namespace App\Models; // Update the namespace for Laravel 8

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'name', 'email', 'message'
        // Add other attributes that should be mass assignable
    ];
}
