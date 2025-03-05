<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Comments;
use Illuminate\Support\Facades\Cache;

class Posts extends Model
{
    //
    use HasFactory;

    protected $fillable = ['title', 'content', 'image_url','slug','category_id'];

    public function comments()
    {
        return $this->hasMany(Comments::class);
    }
    
     // Assuming each post belongs to a category
    public function category()
    {
        return $this->belongsTo(PostCategories::class);
    }
    
      protected static function boot()
    {
        parent::boot();

         static::saved(function ($post) {
            // Define cache keys for the post and related posts
            $postslug = $post->slug; // Assuming 'slug' is the attribute used for caching
            $cacheKeyPost = 'post_' . $postslug;
            $cacheKeyRelatedPosts = 'related_posts_' . $postslug;
            
            Cache::forget('blog_posts');

            // Invalidate the cache for specific post and related posts
            Cache::forget($cacheKeyPost);
            Cache::forget($cacheKeyRelatedPosts);
        });

        static::deleted(function ($post) {
            // Define cache keys for the post and related posts
            $postslug = $post->slug; // Assuming 'slug' is the attribute used for caching
            $cacheKeyPost = 'post_' . $postslug;
            $cacheKeyRelatedPosts = 'related_posts_' . $postslug;
            
            Cache::forget('blog_posts');


            // Invalidate the cache for specific post and related posts
            Cache::forget($cacheKeyPost);
            Cache::forget($cacheKeyRelatedPosts);
        });
        
        
    }
}
