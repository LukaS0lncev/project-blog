<?php

namespace App\Http\Controllers;

use App\Models\News\Post;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index () {

        $posts = Post::paginate(10);
        return view('news.index',['posts' => $posts]);
    }

    public function post($id, $slug) {
        $post = Post::find($id);
        return view('news.post',['post' => $post]);
    }
}
