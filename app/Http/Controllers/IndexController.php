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
        $posts = BlogPost::all()->where('status', 1)->merge(NewsPost::all()->where('status', 1))->sortByDesc('created_at');
        $posts = self::paginate($posts);

        return view('index',['posts' => $posts]);
    }

    protected function paginate($items, $perPage = 10, $page = null, $options = []) {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }



}
