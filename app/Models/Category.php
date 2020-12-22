<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blog\Post as BlogPost;
use App\Models\News\Post as NewsPost;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';

    public function blog_posts()
    {
        return $this->hasOne(BlogPost::class);
    }

    public function news_posts()
    {
        return $this->hasOne(NewsPost::class);
    }

    protected static function booted()
    {
        static::creating(function ($category) {
            $category->slug = translit($category->name);
        });
    }

}
