<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog\Post;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index () {
        $posts = Post::paginate(10);

        return view('index',['posts' => $posts]);

    }
}
