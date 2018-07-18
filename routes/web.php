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

Route::get('/', 'PostController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('posts', 'PostController')->middleware('auth');

Route::get('{post_id}/comments', 'CommentsController@showPostComments')->name('comment.index');
Route::post('{post_id}/comments', 'CommentsController@store')->name('comment.store');

Route::get('{post_id}/countlike', 'LikeController@count')->name('like.count');
Route::get('{post_id}/islike', 'LikeController@count')->middleware('auth')->name('like.isActive');
Route::post('like', 'LikeController@store')->middleware('auth')->name('like.store');
Route::delete('unlike', 'LikeController@destroy')->middleware('auth')->name('like.destroy');