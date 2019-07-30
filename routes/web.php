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

// Route::get('/', function () {
//     return view('welcome');
// });

//home route
Route::get('/', 'PostsController@show');

Route::prefix('posts')->group(function () {
    //posts pages
    Route::get('/', 'PostsController@show')->name('posts');
    Route::get('add', 'PostsController@addPost');
    Route::post('add', 'PostsController@insertPost');
    Route::get('detail/{id}', 'PostsController@viewDetail');
    Route::post('detail/{id}', 'PostsController@updatePost');
    Route::get('delete/{id}', 'PostsController@deletePost');
});

Route::prefix('reports')->group(function () {
    //reports pages
    Route::get('/', 'ReportsController@showGraph');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
