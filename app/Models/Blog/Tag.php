<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $table = 'blog_tags';


    public function posts()
    {
        return $this->belongsToMany(Post::class, 'blog_posts_blog_tags', 'post_id', 'tag_id');
    }
}
