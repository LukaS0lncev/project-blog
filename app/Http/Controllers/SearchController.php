<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use App\Models\Tools\ViewLog;
use Illuminate\Support\Facades\URL;
use App\Articles\ArticlesRepository;

class SearchController extends Controller
{
    public function getIndex (Request $request, ArticlesRepository $repository) {
        $q = $request->q ?? "";
        $posts = $repository->search($q);
        return view('search.index', [
            'blog_posts' => $posts['blog_posts'],
            'news_posts' => $posts['news_posts'],
            'q' => $q
        ]);
    }

}
