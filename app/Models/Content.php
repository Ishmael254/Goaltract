<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;

class Content extends Model
{
    use HasFactory;

    protected $fillable = ['page_name', 'content', 'type'];

    // Boot method to listen for model events
    protected static function boot()
    {
        parent::boot();

        static::saved(function ($content) {
            // Invalidate cache for specific page content
            Cache::forget('content_' . $content->page_name);
                Cache::forget('groups_content');
                            self::invalidateCache($content);


        });

        static::deleted(function ($content) {
            // Invalidate cache for specific page content
            Cache::forget('content_' . $content->page_name);
                Cache::forget('groups_content');
                            self::invalidateCache($content);
        });
        
    }
    
    // Invalidate both database and view cache
    protected static function invalidateCache($content)
    {
        // Define your cache keys
        $cacheKey = 'content_' . $content->page_name;
        $viewCacheKey = 'view_' . $content->page_name;

        // Clear the cache entries
        Cache::forget($cacheKey);
        Cache::forget($viewCacheKey);
    }
}
