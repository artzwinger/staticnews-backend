<?php

use App\Http\Controllers\ArticlesToPublish;
use App\Http\Controllers\PublishArticles;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/articles_to_publish/{websiteId}', ArticlesToPublish::class)->name('articles_to_publish');
Route::post('/publish_articles/{websiteId}', PublishArticles::class)->name('publish_articles');
