<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Tag;
use App\Models\Category;

class Post extends Model
{
    use HasFactory;
    protected $table = 'blog_posts';

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'blog_posts_and_tags', 'post_id', 'tag_id');
    }

    protected static function booted()
    {
        static::creating(function ($post) {
            $parsedown = new \Parsedown();
            $html = $parsedown->text($post->post);
            $html = str_replace('<code>', '<code class="language-php">', $html);
            $post->post_html = $html;
            $slug = self::translit($post->title);
            $post->slug = $slug;
        });

        static::updating(function ($post) {
            $parsedown = new \Parsedown();
            $html = $parsedown->text($post->post);
            $html = str_replace('<code>', '<code class="language-php">', $html);
            $post->post_html = $html;
            $slug = self::translit($post->title);
            $post->slug = $slug;
        });
    }

    protected static function translit($s)
    {
        $s = (string) $s; // преобразуем в строковое значение
        $s = strip_tags($s); // убираем HTML-теги
        $s = str_replace(array("\n", "\r"), " ", $s); // убираем перевод каретки
        $s = preg_replace("/\s+/", ' ', $s); // удаляем повторяющие пробелы
        $s = trim($s); // убираем пробелы в начале и конце строки
        $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)
        $s = strtr($s, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>''));
        $s = preg_replace("/[^0-9a-z-_ ]/i", "", $s); // очищаем строку от недопустимых символов
        $s = str_replace(" ", "-", $s); // заменяем пробелы знаком минус
        return $s; // возвращаем результат
    }
}
