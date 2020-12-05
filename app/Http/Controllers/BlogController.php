<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog\Post;
use Illuminate\Support\Facades\Auth;


class BlogController extends Controller
{
    public function index () {

        $posts = Post::paginate(10);
        return view('blog.index',['posts' => $posts]);
    }

    public function post($id, $slug) {
        $post = Post::find($id);
        return view('blog.post',['post' => $post]);
    }
}
