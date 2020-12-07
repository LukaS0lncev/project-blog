<?php

namespace App\Http\Controllers;

use App\Models\Blog\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CategoryController extends Controller
{

    public function index () {
        $categories = Category::paginate(20);
        return view('category.index',['categories' => $categories]);
    }

    public function category ($slug) {
        $category = Category::where('slug', '=',  $slug)->first();
        $posts = Post::where('category_id', '=', $category->id)->paginate(10);
        return view('category.category',['posts' => $posts, 'category' => $category]);
    }
}
