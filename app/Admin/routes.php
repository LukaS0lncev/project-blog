<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('blog/categories', \Blog\CategoryController::class);
    $router->resource('blog/posts', \Blog\PostController::class);
    $router->resource('blog/tags', \Blog\TagController::class);
    $router->resource('articles', ArticleController::class);
});
