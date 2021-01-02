<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/


Route::get('article/{slug}', [App\Http\Controllers\ArticleController::class, 'article']);

Route::get('/', [App\Http\Controllers\IndexController::class, 'index']);

Route::get('blog', [App\Http\Controllers\BlogController::class, 'index']);
Route::get('blog/{id}-{slug}', [App\Http\Controllers\BlogController::class, 'post']);

Route::get('news', [App\Http\Controllers\NewsController::class, 'index']);
Route::get('news/{id}-{slug}', [App\Http\Controllers\NewsController::class, 'post']);


//Route::post('upload/blog/image', [App\Http\Controllers\UploadController::class, 'PostBlogImageUpload']);
//Route::post('upload/blog/image/paste', [App\Http\Controllers\UploadController::class, 'PostBlogImageUploadPaste']);
//Route::post('upload/blog/file', [App\Http\Controllers\UploadController::class, 'PostBlogFileUpload']);

Route::get('tag', [App\Http\Controllers\TagController::class, 'index']);
Route::get('tag/{slug}', [App\Http\Controllers\TagController::class, 'tag']);

Route::get('category', [\App\Http\Controllers\CategoryController::class, 'index']);
Route::get('category/{slug}', [\App\Http\Controllers\CategoryController::class, 'category']);


/*
Route::post('search', function (ArticlesRepository $repository) {
    $posts = $repository->search(request('q'));
    return view('search.index', [
        'posts' => $posts,
        'q' => request('q')
    ]);
});
*/
//Route::controller('search','SearchController');

Route::get('search', [\App\Http\Controllers\SearchController::class, 'getIndex']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
