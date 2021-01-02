<?php

namespace App\Articles;

use App\Models\Blog\Post as BlogPost;
use App\Models\News\Post as NewsPost;
use Illuminate\Database\Eloquent\Collection;

class EloquentRepository implements ArticlesRepository
{
    public function search(string $query = ''): Array
    {
        $blog_posts =  BlogPost::query()
            ->where('post', 'like', "%{$query}%")
            ->orWhere('title', 'like', "%{$query}%")
            ->get();

        $news_posts =  NewsPost::query()
            ->where('post', 'like', "%{$query}%")
            ->orWhere('title', 'like', "%{$query}%")
            ->get();

        return  array(
            'blog_posts' => $blog_posts,
            'news_posts' => $news_posts,
        );
    }
}
