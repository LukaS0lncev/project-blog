<?php

namespace App\Http\Controllers;

use App\Models\Blog\Post as BlogPost;
use App\Models\News\Post as NewsPost;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Support\Facades\DB;



class IndexController extends Controller
{
    public function index () {
        /*
         * Альтернативный код, но здесь две модели в одну объеденяются, не подходит
         * $posts = BlogPost::query()->union(NewsPost::query())->paginate(10);
         */

        $blogs = DB::table('blog_posts')
            ->join('categories', 'blog_posts.category_id', '=', 'categories.id')
            ->join('users', 'blog_posts.user_id', '=', 'users.id')
            ->select('blog_posts.*', 'categories.name as categories_name', 'categories.slug as categories_slug', 'users.name as user_name')
            ->get()
            ->toArray();

        $blog_post = new BlogPost;
        $blogs = self::addRoute($blogs, $blog_post->route);
        $blogs = self::getTags($blogs, 'blog_posts_and_tags');

        $news = DB::table('news_posts')
            ->join('categories', 'news_posts.category_id', '=', 'categories.id')
            ->join('users', 'news_posts.user_id', '=', 'users.id')
            ->select('news_posts.*', 'categories.name as categories_name', 'categories.slug as categories_slug', 'users.name as user_name')
            ->get()
            ->toArray();
        $news_post = new NewsPost;
        $news = self::addRoute($news, $news_post->route);
        $news = self::getTags($news, 'news_posts_and_tags');

        $posts = array_merge($blogs, $news);
        $posts = self::paginate($posts);

        return view('index',['posts' => $posts]);

    }

    protected function addRoute($posts, $route) {
        foreach ($posts as &$post) {
            $post->route = $route;
        }
        return $posts;
    }
    protected function getTags($posts, $table_name) {
        foreach ($posts as &$post) {
            $tags = array();
            $tags_id = DB::table($table_name)
                ->where('post_id', '=', $post->id)
                ->select('tag_id')
                ->get()
                ->toArray();
            foreach ($tags_id as $tag_id) {
                $db_tag = DB::table('tags')
                    ->where('tags.id', '=', $tag_id->tag_id)
                    ->select('tags.name', 'tags.slug')
                    ->get()
                    ->toArray();
                $tags[] = ['name' => $db_tag[0]->name, 'slug' => $db_tag[0]->slug];
            }
            $post->tags = $tags;
        }

        return $posts;
    }

    protected function paginate($items, $perPage = 10, $page = null, $options = []) {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }



}
