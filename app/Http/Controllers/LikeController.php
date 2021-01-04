<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog\Post as BlogPost;
use App\Models\News\Post as NewsPost;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use App\Models\Tools\LikeLog;
use Illuminate\Support\Facades\URL;
use App\Articles\ArticlesRepository;

class LikeController extends Controller
{
    public function sendLike (BlogPost $blog_post, NewsPost $news_post, Request $request) {

        if(($request->like == 'up') || ($request->like == 'down')) {
            $like_status = $request->like;
        }
        $likes = LikeLog::where('remote_addr', $_SERVER['REMOTE_ADDR'])
            ->where('http_user_agent', $_SERVER['HTTP_USER_AGENT'])
            ->where('model', $request->model)
            ->where('post_id', $request->id)
            ->latest()
            ->first();
        if($likes){
            $likes = $likes->toArray();
        }
        else {
            $likes = array();
        }

        if(count($likes) > 0) {
            if($likes['like_status'] != $like_status) {

                if ($request->model == 'BlogPost') {
                    $model = 'BlogPost';
                    $post_id = $request->id;
                    if($like_status == 'up') {
                        $blog_post::find($post_id)->increment('likes');
                    }
                    if($like_status == 'down') {
                        $blog_post::find($post_id)->decrement('likes');
                    }

                }
                if ($request->model == 'NewsPost') {
                    $model = 'NewsPost';
                    $post_id = $request->id;
                    if($like_status == 'up') {
                        $news_post::find($post_id)->increment('likes');
                    }
                    if($like_status == 'down') {
                        $news_post::find($post_id)->decrement('likes');
                    }
                }

                $like = new LikeLog();
                $like->like_status = $like_status ?? "";
                $like->remote_addr = $_SERVER['REMOTE_ADDR'] ?? "";
                $like->http_user_agent = $_SERVER['HTTP_USER_AGENT'] ?? "";
                $like->model = $model ?? "";
                $like->post_id = $post_id ?? "";
                $like->save();
                return array(
                    'status' => 'ok',
                    'like' => $like_status,
                    'message' => 'Спасибо, ваш голос учтен',
                    'class' => 'alert-success'
                );
            } else {
                return array(
                    'status' => 'error',
                    'like' => $request->like,
                    'message' => 'Вы уже голосовали',
                    'class' => 'alert-warning'
                );
            }

        } else {
            if(($request->like == 'up') || ($request->like == 'down')) {
                $like_status = $request->like;
            }

            if ($request->model == 'BlogPost') {
                $model = 'BlogPost';
                $post_id = $request->id;
                if($like_status == 'up') {
                    $blog_post::find($post_id)->increment('likes');
                }
                if($like_status == 'down') {
                    $blog_post::find($post_id)->decrement('likes');
                }

            }
            if ($request->model == 'NewsPost') {
                $model = 'NewsPost';
                $post_id = $request->id;
                if($like_status == 'up') {
                    $news_post::find($post_id)->increment('likes');
                }
                if($like_status == 'down') {
                    $news_post::find($post_id)->decrement('likes');
                }
            }

            $like = new LikeLog();
            $like->like_status = $like_status ?? "";
            $like->remote_addr = $_SERVER['REMOTE_ADDR'] ?? "";
            $like->http_user_agent = $_SERVER['HTTP_USER_AGENT'] ?? "";
            $like->model = $model ?? "";
            $like->post_id = $post_id ?? "";
            $like->save();
            return array(
                'status' => 'ok',
                'like' => $like_status,
                'message' => 'Спасибо, ваш голос учтен',
                'class' => 'alert-success'
            );
        }
    }

}
