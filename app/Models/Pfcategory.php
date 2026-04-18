<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pfcategory extends Model
{
    protected $fillable = ['name', 'slug', 'description'];

    public function pfposts()
    {
        return $this->hasMany(PfPost::class);
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = static::uniqueSlug(Str::slug($model->name));
            }
        });
    }

    private static function uniqueSlug(string $slug): string
    {
        $original = $slug ?: 'pfcategory';
        $count = 1;
        $slug = $original;
        while (static::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $count++;
        }
        return $slug;
    }
}
