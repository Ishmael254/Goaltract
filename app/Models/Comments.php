<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Posts;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comments extends Model
{
    //
    protected $fillable = ['posts_id', 'user_name', 'content'];

    public function post()
    {
        return $this->belongsTo(Posts::class);
    }
}
