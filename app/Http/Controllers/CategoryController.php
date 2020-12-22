<?php

namespace App\Http\Controllers;

use App\Models\Blog\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class CategoryController extends Controller
{

    public function index () {
        $categories = Category::paginate(20);
        return view('category.index',['categories' => $categories]);
    }

    public function category ($slug) {
        $category = Category::where('slug', '=',  $slug)->first();
        $posts = $category->blog_posts()->where('status', 1)->get()->merge($category->news_posts()->where('status', 1)->get());
        $posts = self::paginate($posts, 10);
        return view('category.category',['posts' => $posts, 'category' => $category]);
    }

    protected function paginate($items, $perPage = 10, $page = null, $options = []) {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
