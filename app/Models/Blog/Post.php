<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Tag;
use App\Models\Category;

class Post extends Model
{
    use HasFactory;
    protected $table = 'blog_posts';

    /*
    protected $attributes = [
        'route' => '/blog/',
    ];
    */

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'blog_posts_and_tags', 'post_id', 'tag_id');
    }

    protected static function booted()
    {
        static::creating(function ($post) {
            $parsedown = new \Parsedown();
            $html = $parsedown->text($post->post);
            $html = str_replace('<code>', '<code class="language-php">', $html);
            $post->post_html = $html;
            $post->path = "/blog/";
            $slug = translit($post->title);
            $post->slug = $slug;
        });

        static::updating(function ($post) {
            $parsedown = new \Parsedown();
            $html = $parsedown->text($post->post);
            $html = str_replace('<code>', '<code class="language-php">', $html);
            $post->post_html = $html;
            $slug = translit($post->title);
            $post->slug = $slug;
        });
    }

}
