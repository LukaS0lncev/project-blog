<?php

namespace App\Http\Controllers;

//use Encore\Admin\Form\Field\Tags;
use Illuminate\Http\Request;
use App\Models\Blog\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use App\Models\Tools\ViewLog;
use Illuminate\Support\Facades\URL;


class BlogController extends Controller
{
    public function index () {

        $posts = Post::where('status', 1)->orderBy('created_at', 'DESC')->paginate(10);
        return view('blog.index',['posts' => $posts]);
    }

    public function post($id, $slug) {
        $post = Post::find($id);
        $view = new ViewLog();
        $view->remote_addr = $_SERVER['REMOTE_ADDR'] ?? "";
        $view->http_referer = $_SERVER['HTTP_REFERER'] ?? "";
        $view->http_user_agent = $_SERVER['HTTP_USER_AGENT'] ?? "";
        $view->viewed_url = URL::current();
        $view->save();

        if (empty($post->views)) {
            $post->views = 1;
        }
        else {
            $post->increment('views');
        }
        $post->save();
        return view('blog.post',['post' => $post]);
    }
}
