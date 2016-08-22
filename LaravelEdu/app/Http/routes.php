<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

/* Home */
Route::get('/', 'Web\ArticlesController@index')->name('web.articles.index');
Route::get('/articles/{articles}', 'Web\ArticlesController@show')->name('web.articles.show');

/* Comments */
Route::post('/articles/{articles}', 'Web\CommentsController@store')->name('web.comments.store');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
    /* Admin panel */
    Route::resource('/articles', 'Admin\ArticlesController');
});