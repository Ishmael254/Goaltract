<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class PostCategories extends Model
{
    //
    protected $fillable = ['name'];
    
     public function posts()
    {
        return $this->hasMany(Posts::class);
    }
    
     protected static function boot()
    {
        parent::boot();

        static::saved(function () {
            // Invalidate cache for blog categories
            Cache::forget('blog_categories');
        });

        static::deleted(function () {
            // Invalidate cache for blog categories
            Cache::forget('blog_categories');
        });
    }

}
