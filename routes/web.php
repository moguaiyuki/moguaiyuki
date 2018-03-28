<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * 管理画面のルーティング
 * "App\Http\Controllers\Admin"名前空間下のコントローラを使用
 * admin/ prefix
 * ルート名　admin. prefix
 * TODO: ミドルウェアの設定
 */
Route::name('admin.')->prefix('admin')->namespace('Admin')->group(function () {

    Route::get('/', 'HomeController@index')->name('admin');

    Route::resource('users', 'UsersController');

    Route::resource('ted-talks', 'TedTalksController');

    Route::name('ted-talks.')->prefix('ted-talks')->group(function () {
        Route::resource('reviews', 'TedReviewsController');
        Route::get('reviews/register/{talk_id}', 'TedReviewsController@register')->name('reviews.register');
    });

    Route::resource('books', 'BooksController');

    Route::name('books.')->prefix('books')->group(function () {
        Route::resource('reviews', 'BookReviewsController');
        Route::get('reviews/register/{book_id}', 'BookReviewsController@register')->name('reviews.register');
    });

    Route::resource('travels', 'TravelsController');

});