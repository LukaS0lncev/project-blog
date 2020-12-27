<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('categories', \CategoryController::class);
    $router->resource('tags', \TagController::class);
    $router->resource('blog/posts', \Blog\PostController::class);
    $router->resource('news/posts', \News\PostController::class);
    $router->resource('tools/view/log', \Tools\ViewLogController::class);
    $router->resource('articles', ArticleController::class);

    $router->get('upload/blog/image', [App\Http\Controllers\UploadController::class, 'index']);
    $router->post('upload/blog/image', [App\Http\Controllers\UploadController::class, 'PostBlogImageUpload']);
    $router->post('upload/blog/image/paste', [App\Http\Controllers\UploadController::class, 'PostBlogImageUploadPaste']);
    $router->post('upload/blog/file', [App\Http\Controllers\UploadController::class, 'PostBlogFileUpload']);

});
