<?php

namespace App\Http\Controllers;

use App\Models\News\Post;
use App\Models\Tools\ViewLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class NewsController extends Controller
{
    public function index () {

        $posts = Post::where('status', 1)->orderBy('created_at', 'DESC')->paginate(10);
        return view('news.index',['posts' => $posts]);
    }

    public function post($id, $slug) {
        $post = Post::find($id);
        $view = new ViewLog();
        $view->remote_addr = $_SERVER['REMOTE_ADDR'];
        $view->http_referer = $_SERVER['HTTP_REFERER'];
        $view->http_user_agent = $_SERVER['HTTP_USER_AGENT'];
        $view->viewed_url = URL::current();
        $view->save();
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
