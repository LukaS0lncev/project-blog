<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog\Post;
use Illuminate\Support\Facades\Auth;


class BlogController extends Controller
{
    public function index () {

        $user = Auth::user();
        dd($user);
        $parsedown = new \Parsedown();
        $posts = Post::all();

        foreach ($posts as &$post){
            $post->post = $parsedown->text($post->post);
        }

        return view('test',['posts' => $posts]);

    }
}
