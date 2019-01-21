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
Route::group(['middleware' => ['auth']], function (){
	Route::get('/', 'PostsController@index')->name('root');
	Route::get('/home', 'PostsController@index')->name('home');
	Route::get('/about', 'HomeController@about')->name('about');
	
	Route::get('/posts/create', 'PostsController@create')->name('posts.create');
	Route::post('/posts/store', 'PostsController@store')->name('posts.store');
	Route::get('/posts/edit/{id}', 'PostsController@edit')->name('posts.edit');
	Route::post('/posts/update/{id}', 'PostsController@update')->name('posts.update');
});
Route::get('/posts', 'PostsController@index')->name('posts');
Route::get('/posts/show/{id}', 'PostsController@show')->name('posts.show');

Route::get('/contact', 'HomeController@about')->name('contact')->middleware('auth');

// ajax 
Route::get('ajax/nextPage', 'PostsController@nextPage')->name('ajax.nextPage');
Route::post('ajax/like', 'LikeController@like')->name('ajax.like');
Route::post('ajax/dislike', 'LikeController@dislike')->name('ajax.dislike');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
