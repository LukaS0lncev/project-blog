<?php

namespace App\Http\Controllers;

use App\Models\News\Post;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index () {

        $posts = Post::where('status', 1)->orderBy('created_at', 'DESC')->paginate(10);
        return view('news.index',['posts' => $posts]);
    }

    public function post($id, $slug) {
        $post = Post::find($id);
        if (empty($post->views)) {
            $post->views = 1;
        }
        else {
            $post->increment('views');
        }
        $post->save();
        return view('news.post',['post' => $post]);
    }
}
