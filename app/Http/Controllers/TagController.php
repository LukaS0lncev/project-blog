<?php

namespace App\Http\Controllers;

use App\Models\Blog\Post;
use App\Models\Tag;

use Encore\Admin\Facades\Admin;
use Encore\Admin\Auth;
use Encore\Admin\Middleware;
use Encore\Admin\Auth\Permission;


use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TagController extends Controller
{
    public function __construct()
    {

        //dd(Admin::user()->isAdministrator());
        //Admin::user();
        //dd(Admin::user());
        //if(!Admin::user()->isAdministrator()){
        //    return new Response('Forbidden', 403);
        //}
    }

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
