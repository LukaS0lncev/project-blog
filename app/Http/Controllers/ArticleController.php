<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function article($slug) {
        $article = Article::where('slug', '=', $slug)->firstOrFail();
        return view('article.index',['article' => $article]);
    }
}
