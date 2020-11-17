<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'blog_posts';

    public function category()
    {
        return $this->belongsTo(Category::class, 'blog_category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'blog_posts_blog_tags', 'post_id', 'tag_id');
    }
}
