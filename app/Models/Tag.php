<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blog\Post;

class Tag extends Model
{
    use HasFactory;
    protected $table = 'tags';


    public function posts()
    {
        return $this->belongsToMany(Post::class, 'blog_posts_and_tags', 'tag_id', 'post_id');
    }

    protected static function booted()
    {
        static::creating(function ($tag) {
            $tag->slug = translit($tag->name);
        });
    }

}
