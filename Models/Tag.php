<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    protected $fillable = ['tag', 'slug'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = static::uniqueSlug(Str::slug($model->tag));
            }
        });
    }

    private static function uniqueSlug(string $slug): string
    {
        $original = $slug ?: 'tag';
        $count = 1;
        $slug = $original;
        while (static::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $count++;
        }
        return $slug;
    }
}
