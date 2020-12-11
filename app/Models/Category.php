<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blog\Post;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';

    public function posts()
    {
        return $this->hasOne(Post::class);
    }

    protected static function booted()
    {
        static::creating(function ($category) {
            $category->slug = translit($category->name);
        });
    }

}
