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

/**
 * フロント画面のルーティング
 *
 */
Route::get('/', 'HomeController@index')->name('index');

Route::get('profile', function(){
    return view('front.profile.index');
})->name('profile');

Route::name('programing.')->group(function() {
    Route::get('programing/', 'ProgramingController@index')->name('index');
    Route::get('programing/{slug}', 'ProgramingController@show')->name('show');
    Route::get('programing/tag/{id}', 'ProgramingController@searchTag')->name('search-tag');
});

Route::name('books.')->group(function() {
    Route::get('books/', 'BooksController@index')->name('index');
    Route::get('books/{slug}', 'BooksController@show')->name('show');
    Route::get('books/tag/{id}', 'BooksController@searchTag')->name('search-tag');
});

Route::name('english.')->group(function() {
    Route::get('english/', 'EnglishController@index')->name('index');
    Route::get('english/{slug}', 'EnglishController@show')->name('show');
    Route::get('english/tag/{id}', 'EnglishController@searchTag')->name('search-tag');
});

Route::name('ted-talks.')->group(function() {
    Route::get('ted-talks/', 'TedTalksController@index')->name('index');
    Route::get('ted-talks/{slug}', 'TedTalksController@show')->name('show');
    Route::get('ted-talks/tag/{id}', 'TedTalksController@searchTag')->name('search-tag');
});

Route::name('marketing.')->group(function() {
    Route::get('marketing/', 'MarketingController@index')->name('index');
    Route::get('marketing/{slug}', 'MarketingController@show')->name('show');
    Route::get('marketing/tag/{id}', 'MarketingController@searchTag')->name('search-tag');
});

Route::name('travels.')->group(function() {
    Route::get('travels/', 'TravelsController@index')->name('index');
    Route::get('travels/{slug}', 'TravelsController@show')->name('show');
    Route::get('travels/tag/{id}', 'TravelsController@searchTag')->name('search-tag');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * 管理画面のルーティング
 * "App\Http\Controllers\Admin"名前空間下のコントローラを使用
 * admin/ prefix
 * ルート名　admin. prefix
 */
Route::middleware('auth')->name('admin.')->prefix('admin')->namespace('Admin')->group(function () {

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
        Route::post('info', 'BooksController@searchBooksInfo')->name('info');
        Route::get('reviews/register/{book_id}', 'BookReviewsController@register')->name('reviews.register');
    });

    Route::resource('travels', 'TravelsController');

    Route::resource('programing', 'ProgramingController');

    Route::resource('marketing', 'MarketingController');

    Route::resource('english', 'EnglishController');
});