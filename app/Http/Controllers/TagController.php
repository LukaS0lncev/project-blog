<?php

namespace App\Http\Controllers;

use App\Models\Blog\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index () {
        $tags = Tag::paginate(20);
        return view('tag.index',['tags' => $tags]);
    }

    public function tag ($slug) {
        $tag = Tag::where('slug', '=',  $slug)->first();
        $posts = $tag->posts()->paginate(10);
        return view('tag.tag',['posts' => $posts, 'tag' => $tag]);
    }
}
