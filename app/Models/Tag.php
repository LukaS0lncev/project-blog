<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blog\Post as BlogPost;
use App\Models\News\Post as NewsPost;

class Tag extends Model
{
    use HasFactory;
    protected $table = 'tags';


    public function blog_posts()
    {
        return $this->belongsToMany(BlogPost::class, 'blog_posts_and_tags', 'tag_id', 'post_id');
    }

    public function news_posts()
    {
        return $this->belongsToMany(NewsPost::class, 'news_posts_and_tags', 'tag_id', 'post_id');
    }

    protected static function booted()
    {
        static::creating(function ($tag) {
            $tag->slug = translit($tag->name);
        });
    }

}
