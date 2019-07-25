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

Route::get('/posts', 'PostsController@show');
Route::get('/posts/add', 'PostsController@addPost');
Route::post('/posts/add', 'PostsController@insertPost');
Route::get('/posts/detail/{id}', 'PostsController@viewDetail');
Route::post('/posts/detail/{id}', 'PostsController@updatePost');
Route::get('/posts/delete/{id}', 'PostsController@deletePost');
