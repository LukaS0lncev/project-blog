<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::creating(function ($article) {
            $parsedown = new \Parsedown();
            $article->article_html = $parsedown->text($article->article);
            $slug = translit($article->title);
            $article->slug = $slug;
        });

        static::updating(function ($article) {
            $parsedown = new \Parsedown();
            $article->article_html = $parsedown->text($article->article);
            $slug = translit($article->title);
            $article->slug = $slug;
        });
    }

}
