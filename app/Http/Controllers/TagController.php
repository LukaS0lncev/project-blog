<?php

namespace App\Http\Controllers;

use App\Models\Blog\Post as BlogPost;
use App\Models\News\Post as NewsPost;
use App\Models\Tag;

use Encore\Admin\Facades\Admin;
use Encore\Admin\Auth;
use Encore\Admin\Middleware;
use Encore\Admin\Auth\Permission;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;


class TagController extends Controller
{
    public function __construct()
    {

    }

    public function index () {
        $tags = Tag::paginate(20);
        return view('tag.index',['tags' => $tags]);
    }

    public function tag ($slug) {

        $tag = Tag::where('slug', '=',  $slug)->first();
        $posts = $tag->blog_posts()->get()->merge($tag->news_posts()->get());
        $posts = self::paginate($posts);
        return view('tag.tag',['posts' => $posts, 'tag' => $tag]);
    }

    protected function paginate($items, $perPage = 10, $page = null, $options = []) {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
