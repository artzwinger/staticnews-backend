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
    return redirect(route('filament.auth.login'));
});
Route::get('/login', function () {
    return redirect(route('filament.auth.login'));
})->name('login');

Route::get('/articles_to_publish/{websiteCode}', ArticlesToPublish::class)->name('articles_to_publish');
Route::post('/publish_articles', PublishArticles::class)->name('publish_articles');
