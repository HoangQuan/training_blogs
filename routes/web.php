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
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/posts', 'PostsController@index')->name('posts');
Route::get('/posts/show/{id}', 'PostsController@show')->name('posts.show');
Route::get('/contact', 'HomeController@about')->name('contact');

// ajax 
Route::get('ajax/nextPage', 'PostsController@nextPage')->name('ajax.nextPage');

Route::get('/', function () {
    return view('welcome');
});
