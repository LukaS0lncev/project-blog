<?php

namespace App\Http\Controllers;

//use Encore\Admin\Form\Field\Tags;
use Illuminate\Http\Request;
use App\Models\Blog\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;


class BlogController extends Controller
{
    public function index () {

        $posts = Post::where('status', 1)->paginate(10);

        return view('blog.index',['posts' => $posts]);
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
        return view('blog.post',['post' => $post]);
    }
}
